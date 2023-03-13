<?php

namespace App\Http\Controllers;

use App\Dostava;
use App\DostavaBroj;
use App\DostavaStavka;
use App\Korisnik;
use App\PosiljalacPrimalac;
use App\Posiljka;
use App\View\Components\PosiljkaTabela;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DostavaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spisak = Dostava::with([
            'stavke'
        ]);

        if (request()->search_po) {
            $spisak = $spisak->whereHas('stavke', function ($q) {
                $q->whereRaw('lower(posiljka.broj_posiljke) LIKE ?', ['%'.strtolower(request()->search_po.'%')]);
            });
        }

        if (request()->search) {
            $spisak = $spisak->whereRaw('lower(broj_spiska) LIKE ?', ['%'.strtolower(request()->search.'%')]);
        }

        if (request()->search_radnik) {
            $spisak = $spisak->whereRaw('lower(radnik) LIKE ?', ['%'.strtolower(request()->search_radnik.'%')]);
        }

        $izabran_bar_jedan_datum = false;
        if (request()->date_from) {
            $spisak = $spisak->whereRaw('date(za_datum) >= ?', [Carbon::parse(request()->date_from)->format('Y-m-d')]);
            $izabran_bar_jedan_datum = true;
        }

        if (request()->date_to) {
            $spisak = $spisak->whereRaw('date(za_datum) <= ?', [Carbon::parse(request()->date_to)->format('Y-m-d')]);
            $izabran_bar_jedan_datum = true;
        }

        if (!$izabran_bar_jedan_datum) {
            $spisak = $spisak->whereRaw('date(za_datum) = ?', [Carbon::now()->format('Y-m-d')]);
        }

        // if (request()->date) {
        //     $spisak = $spisak->whereRaw('date(created_at) = ?', [Carbon::parse(request()->date)->format('Y-m-d')]);
        // } else {
        //     $spisak = $spisak->whereRaw('date(created_at) = ?', [Carbon::now()->format('Y-m-d')]);
        // }

        $spisak = $spisak->get();

        $posiljke = Posiljka::join('dostava_stavka', 'posiljka.id', '=', 'dostava_stavka.posiljka_id')
                    ->join('dostava', 'dostava_stavka.dostava_id', '=', 'dostava.id')
                    ->whereIn('dostava_stavka.dostava_id', $spisak->pluck('id')->toArray())
                    ->where('dostava_stavka.status', 2)
                    ->select(
                        'posiljka.*', 
                        'dostava.radnik', 
                        'dostava.broj_spiska', 
                        'dostava_stavka.status as status_po_spisku', 
                        'dostava_stavka.dostava_id', 
                        'dostava_stavka.deleted_at as stavka_obrisana'
                    )
                    // ->orderBy('posiljka.primalac_id', 'asc')
                    // ->orderBy('dostava.radnik', 'asc')
                    ->havingRaw('stavka_obrisana IS NULL')
                    ->get();

        $izvestaj = new PosiljkaTabela($posiljke, $spisak);

        return view('dostava.index', compact('spisak', 'izvestaj'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brojDostave = DostavaBroj::poslednjiBrojFormat();

        $dostava = new Dostava;
        $posiljkeDostave = [];
        $posiljke = Posiljka::
                    whereRaw('date(created_at) <= ?', [Carbon::now()->format('Y-m-d')])
                    ->where('interna', 1)
                    ->select(['id', 'broj_posiljke'])
                    ->addSelect(DB::raw('
                        (SELECT COUNT(*) 
                            FROM dostava_stavka 
                            WHERE dostava_stavka.posiljka_id = posiljka.id AND 
                            (
                                SELECT COUNT(*) 
                                FROM dostava 
                                WHERE dostava_stavka.dostava_id = dostava.id 
                                AND dostava.status = 0 
                                AND dostava.deleted_at IS NULL
                            )
                            AND dostava_stavka.deleted_at IS NULL
                        ) AS postoji_na_zaduzenom_spisku'))
                    ->addSelect(DB::raw(
                        '(
                            SELECT COUNT(*) 
                            FROM dostava_stavka
                            WHERE dostava_stavka.posiljka_id = posiljka.id 
                            AND dostava_stavka.status = 2
                            AND dostava_stavka.deleted_at IS NULL
                        ) AS urucen_status'
                    ))
                    ->having('postoji_na_zaduzenom_spisku', 0)
                    ->having('urucen_status', 0)
                    ->orderBy('id', 'desc')
                    ->get();
        
        //dd($posiljke);

        return view('dostava.create', compact('posiljke', 'posiljkeDostave', 'dostava', 'brojDostave'));
    }

    public function posiljke($ids)
    {
        $posiljke = Posiljka::whereIn('id', explode(',', $ids))->get();
        $posiljkeComponent = new PosiljkaTabela($posiljke);
        
        return $posiljkeComponent->render()->render();
    }

    public function posiljkeNaDostavi($ids, $dostava_id)
    {
        $dostava = Dostava::findOrFail($dostava_id);
        $posiljke = Posiljka::
            whereIn('posiljka.id', explode(',', $ids))
            ->select('posiljka.*')
            ->addSelect(DB::raw(
                '(
                    SELECT id
                    FROM dostava_stavka
                    WHERE dostava_stavka.dostava_id = '.$dostava_id.'
                    AND dostava_stavka.posiljka_id = posiljka.id
                    AND deleted_at IS NULL
                ) as ds_id'
            ))
            ->addSelect(DB::raw(
                '(
                    SELECT vracena
                    FROM dostava_stavka
                    WHERE dostava_stavka.dostava_id = '.$dostava_id.'
                    AND dostava_stavka.posiljka_id = posiljka.id
                    AND deleted_at IS NULL
                ) as vracena_posiljka'
            ))
            ->addSelect(DB::raw(
                '(
                    SELECT status
                    FROM dostava_stavka
                    WHERE dostava_stavka.dostava_id = '.$dostava_id.'
                    AND dostava_stavka.posiljka_id = posiljka.id
                    AND deleted_at IS NULL
                ) as status_po_spisku'
            ))
            ->orderBy('ds_id')
            ->get();
        
        $posiljke->transform(function($item) use ($dostava_id) {
            $item->id_dostava = $dostava_id;
            return $item;
        });

        //dd($posiljke);

        $posiljkeComponent = new PosiljkaTabela($posiljke, $dostava);
        
        return $posiljkeComponent->render()->render();
    }

    public function posiljkeUnete($id_dostava)
    {
        $ids = DostavaStavka::where('dostava_id', $id_dostava)->where('deleted_at', null)->pluck('posiljka_id')->toArray();
        $posiljke = Posiljka::
            whereIn('posiljka.id', $ids)
            ->select('posiljka.*')
            ->addSelect(DB::raw(
                '(
                    SELECT id
                    FROM dostava_stavka
                    WHERE dostava_stavka.dostava_id = '.$id_dostava.'
                    AND dostava_stavka.posiljka_id = posiljka.id
                    AND deleted_at IS NULL
                ) as ds_id'
            ))
            ->addSelect(DB::raw(
                '(
                    SELECT vracena
                    FROM dostava_stavka
                    WHERE dostava_stavka.dostava_id = '.$id_dostava.'
                    AND dostava_stavka.posiljka_id = posiljka.id
                    AND deleted_at IS NULL
                ) as vracena_posiljka'
            ))
            ->addSelect(DB::raw(
                '(
                    SELECT status
                    FROM dostava_stavka
                    WHERE dostava_stavka.dostava_id = '.$id_dostava.'
                    AND dostava_stavka.posiljka_id = posiljka.id
                    AND deleted_at IS NULL
                ) as status_po_spisku'
            ))
            ->orderBy('ds_id')
            ->get();
        
        $posiljke->transform(function($item) use ($id_dostava) {
            $item->id_dostava = $id_dostava;
            return $item;
        });

        $dostava = Dostava::where('id', $id_dostava)->first();
        $posiljkeComponent = new PosiljkaTabela($posiljke, $dostava);
        $mozeDaSeRazduzi = DostavaStavka::mozeDaSeRazduzi($id_dostava);
        
        return response()->json([
            'html' => $posiljkeComponent->render()->render(), 
            'razduzi' => $mozeDaSeRazduzi, 
            'razduzen' => $dostava->status
        ]);
    }

    public function razduzi($id)
    {
        $dostava = Dostava::with(['stavke'])->findOrFail($id);
        $dostava->status = 1;
        $dostava->za_naplatu = $dostava->stavke()->where('dostava_stavka.status', 2)->sum(DB::raw('posiljka.vrednost + posiljka.postarina'));
        
        $postarinaExtra = $dostava->stavke()
            ->where('dostava_stavka.status', 3)
            ->where('posiljka.nacin_placanja_id', 3)
            ->where('dostava_stavka.vracena', 1)
            ->sum(DB::raw('posiljka.postarina * 2'));

        $dostava->za_naplatu += $postarinaExtra;
        $dostava->save();

        return redirect()->route('cms.dostava.index');
    }

    public function razduziSve($id)
    {
        DostavaStavka::where('dostava_id', $id)->whereIn('status', [0, 1])->update([
            'status' => 2
        ]);

        $dostava = Dostava::with(['stavke'])->findOrFail($id);
        $dostava->status = 1;
        $dostava->za_naplatu = $dostava->stavke()->where('dostava_stavka.status', 2)->sum(DB::raw('posiljka.vrednost + posiljka.postarina'));
        
        $postarinaExtra = $dostava->stavke()
            ->where('dostava_stavka.status', 3)
            ->where('posiljka.nacin_placanja_id', 3)
            ->where('dostava_stavka.vracena', 1)
            ->sum(DB::raw('posiljka.postarina * 2'));

        $dostava->za_naplatu += $postarinaExtra;
        $dostava->save();

        return redirect()->route('cms.dostava.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dostava = new Dostava;
        $dostava->broj_spiska = $request->broj_spiska;
        $dostava->radnik = $request->radnik;
        $dostava->za_datum = $request->datum;
        //$dostava->za_naplatu = Posiljka::whereIn('id', $request->posiljke ?? [])->where('status', 1)->sum(DB::raw('vrednost + postarina'));
        $dostava->save();

        DostavaBroj::povecajBroj();

        if ($request->posiljke) {
            DB::transaction(function () use ($request, $dostava) {
                foreach ($request->posiljke as $posiljka) {
                    $dostavaStavka = new DostavaStavka;
                    $dostavaStavka->dostava_id = $dostava->id;
                    $dostavaStavka->posiljka_id = $posiljka;
                    $dostavaStavka->status = 0;
                    $dostavaStavka->save();
                }
            });
        }
        
        return redirect()->route('cms.dostava.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dostava = Dostava::with([
            'stavke',
            'stavke.posiljalac',
            'stavke.posiljalac.ulica',
            'stavke.posiljalac.naselje',
            'stavke.primalac',
            'stavke.primalac.ulica',
            'stavke.primalac.naselje',
            'stavke.vrstaUsluge',
            'stavke.nacinPlacanja',
            'stavke.firma'
        ])->find($id);

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultParagraphStyle(array('align' => 'both', 'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0), 'spacing' => 0));
        $section = $phpWord->addSection(array('orientation' => 'landscape'));
        
        $header = array('size' => 16, 'bold' => true);
        $section->addText(htmlspecialchars('Dostavni spisak broj: '.$dostava->broj_spiska.' Datum: '.date('d.m.Y.', strtotime($dostava->za_datum))), $header);
        $section->addTextBreak(1);

        $section->addText(htmlspecialchars('Legenda:'), $header);
        $section->addTextBreak(1);

        $header2 = array('size' => 9, 'bold' => false);
        $headerNoBold = array('size' => 12, 'bold' => false);

        $section->addText(htmlspecialchars('1 - OBAVEŠTEN'), $header2);
        $section->addText(htmlspecialchars('2 - NAREDNA DOSTAVA'), $header2);
        $section->addText(htmlspecialchars('3 - NEPOZNAT NA ADRESI'), $header2);
        $section->addText(htmlspecialchars('4 - ODSELJEN'), $header2);
        $section->addText(htmlspecialchars('5 - ODBIJA PRIJEM'), $header2);
        $section->addText(htmlspecialchars('6 - IZGUBLJENA POŠILJKA'), $header2);
            
        $section->addTextBreak(1);

        $styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80);
        $styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '000000');
        $styleCell = array('space' => array('line' => 1000));
        $fontStyle = array('bold' => true, 'align' => 'center');
        $phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
        $table = $section->addTable('Fancy Table');

        $table->addRow();
        $table->addCell(500, $styleCell)->addText(htmlspecialchars('R.B.'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('BROJ POŠILJKE'), $fontStyle);
        $table->addCell(2500, $styleCell)->addText(htmlspecialchars('PRIMALAC'), $fontStyle);
        $table->addCell(2500, $styleCell)->addText(htmlspecialchars('MESTO'), $fontStyle);
        $table->addCell(3000, $styleCell)->addText(htmlspecialchars('ADRESA'), $fontStyle);
        $table->addCell(1500, $styleCell)->addText(htmlspecialchars('ZA NAPLATU'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('POTPIS'), $fontStyle);
        $table->addCell(1000, $styleCell)->addText(htmlspecialchars('VREME'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('NAPOMENA'), $fontStyle);

        $rb = 1;
        foreach ($dostava->stavke as $stavka) {
            $table->addRow();

            $c1 = $table->addCell(500);
            $c1->addText(htmlspecialchars($rb));
            
            $c2 = $table->addCell(2000);
            $c2->addText(htmlspecialchars($stavka->broj_posiljke));

            $c3 = $table->addCell(2500);
            $c3->addText(htmlspecialchars($stavka->primalac->naziv));
            $c3->addText(htmlspecialchars($stavka->primalac->kontakt_telefon));

            $c4 = $table->addCell(3000);
            $c4->addText(htmlspecialchars($stavka->primalac->naselje));

            $adresa = $stavka->primalac->ulica.' '.$stavka->primalac->broj.''.($stavka->primalac->podbroj != '' ? '('.$stavka->primalac->podbroj.')' : '');
            if ($stavka->primalac->stan != '') {
                $adresa .= '/'.$stavka->primalac->stan;
            }

            $c5 = $table->addCell(2500);
            $c5->addText(htmlspecialchars($adresa));

            if ($stavka->primalac->sprat) {
                $c5->addText(htmlspecialchars('Sprat: '.$stavka->primalac->sprat));
            }

            $c6 = $table->addCell(1500);
            $c6->addText(htmlspecialchars(number_format($stavka->vrednost + $stavka->postarina, 2, ',', '.')));

            $c7 = $table->addCell(2000)->addText(htmlspecialchars(''));
            $c8 = $table->addCell(1000)->addText(htmlspecialchars(''));
            $c9 = $table->addCell(2000)->addText(htmlspecialchars(''));

            $rb++;
        }
        
        $section->addTextBreak(1);
        $section->addText(htmlspecialchars('POŠILJKE PREDAO: '.Korisnik::ulogovanKorisnik()->ime.' '.Korisnik::ulogovanKorisnik()->prezime));
        $section->addTextBreak(1);
        $section->addText(htmlspecialchars('POŠILJKE PRIMIO: '.$dostava->radnik));

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path($dostava->broj_spiska.'.docx'));
        } catch (\Exception $e) {
            dd($e);
        }

        return response()->download(storage_path($dostava->broj_spiska.'.docx'))->deleteFileAfterSend(true);
    }

    public function spisakPoPosiljaocu($id, $posiljalac_id)
    {
        $dostava = Dostava::with([
            'stavke' => function($q) use ($posiljalac_id) {
                $q->where('dostava_stavka.status', 2);
                $q->whereNull('dostava_stavka.deleted_at');
                $q->where('posiljka.posiljalac_id', $posiljalac_id);
            },
            'stavke.posiljalac',
            'stavke.posiljalac.ulica',
            'stavke.posiljalac.naselje',
            'stavke.primalac',
            'stavke.primalac.ulica',
            'stavke.primalac.naselje',
            'stavke.vrstaUsluge',
            'stavke.nacinPlacanja',
            'stavke.firma'
        ])
        ->findOrFail($id);

        $posiljalac = PosiljalacPrimalac::findOrFail($posiljalac_id);

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultParagraphStyle(array('align' => 'both', 'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0), 'spacing' => 0));
        $section = $phpWord->addSection(array('orientation' => 'landscape'));
        
        $header = array('size' => 16, 'bold' => true);
        $section->addText(htmlspecialchars('Pošiljalac: '.$posiljalac->naziv), $header);
        $section->addTextBreak(1);
        $section->addText(htmlspecialchars('Broj spiska: '.$dostava->broj_spiska.' Datum: '.date('d.m.Y.', strtotime($dostava->za_datum))), $header);
        $section->addTextBreak(1);

        $styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80);
        $styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '000000');
        $styleCell = array('space' => array('line' => 1000));
        $fontStyle = array('bold' => true, 'align' => 'center');
        $phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
        $table = $section->addTable('Fancy Table');

        $table->addRow();
        $table->addCell(500, $styleCell)->addText(htmlspecialchars('R.B.'), $fontStyle);
        $table->addCell(3000, $styleCell)->addText(htmlspecialchars('PRIMALAC'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('BROJ POŠILJKE'), $fontStyle);
        $table->addCell(3000, $styleCell)->addText(htmlspecialchars('NAČIN PLAĆANJA'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('IZNOS'), $fontStyle);
        $table->addCell(2500, $styleCell)->addText(htmlspecialchars('NAPOMENA'), $fontStyle);

        $rb = 1;
        $za_isplatu = 0;
        foreach ($dostava->stavke as $stavka) {
            $za_isplatu += (float) $stavka->vrednost;
            $stavka_vrednost = number_format($stavka->vrednost, 2);

            if ($stavka->nacin_placanja_id == 2 || $stavka->nacin_placanja_id == 4) {
                $za_isplatu += (float) $stavka->postarina;
                $stavka_vrednost .= ' + ' . number_format($stavka->postarina, 2);
            }

            $table->addRow();

            $c1 = $table->addCell(500);
            $c1->addText(htmlspecialchars($rb));

            $c2 = $table->addCell(3000);
            $c2->addText(htmlspecialchars($stavka->primalac->naziv));
            //$c2->addText(htmlspecialchars($stavka->primalac->kontakt_telefon));
            
            $c3 = $table->addCell(2000);
            $c3->addText(htmlspecialchars($stavka->broj_posiljke));

            $c4 = $table->addCell(3000);
            $c4->addText(htmlspecialchars(strtoupper($stavka->nacinPlacanja->naziv)));

            $c5 = $table->addCell(2000);
            $c5->addText(htmlspecialchars($stavka_vrednost));
            
            $c6 = $table->addCell(2500);
            $c6->addText(htmlspecialchars(''));

            $rb++;
        }

        $table->addRow();

        $c1 = $table->addCell(500);
        $c1->addText(htmlspecialchars(''));

        $c2 = $table->addCell(3000);
        $c2->addText(htmlspecialchars(''));
        //$c2->addText(htmlspecialchars($stavka->primalac->kontakt_telefon));
        
        $c3 = $table->addCell(2000);
        $c3->addText(htmlspecialchars(''));

        $c4 = $table->addCell(3000);
        $c4->addText(htmlspecialchars('UKUPNO'));

        $c5 = $table->addCell(2000);
        $c5->addText(htmlspecialchars(number_format($za_isplatu, 2)));
        
        $c6 = $table->addCell(2500);
        $c6->addText(htmlspecialchars(''));
        
        $section->addTextBreak(1);
        $section->addText(htmlspecialchars('POŠILJKE PREDAO: '.Korisnik::ulogovanKorisnik()->ime.' '.Korisnik::ulogovanKorisnik()->prezime));
        $section->addTextBreak(1);
        $section->addText(htmlspecialchars('POŠILJKE PRIMIO: '.$dostava->radnik));

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path($dostava->broj_spiska.'_'.$posiljalac->naziv.'.docx'));
        } catch (\Exception $e) {
            dd($e);
        }

        return response()->download(storage_path($dostava->broj_spiska.'_'.$posiljalac->naziv.'.docx'))->deleteFileAfterSend(true);
    }

    public function spiskoviPoPosiljaocu($spiskovi, $posiljalac_id, $datum_od = null, $datum_do = null)
    {
        $posiljalac = PosiljalacPrimalac::findOrFail($posiljalac_id);

        $posiljke = Posiljka::with(['primalac', 'nacinPlacanja'])
            ->join('dostava_stavka', 'posiljka.id', '=', 'dostava_stavka.posiljka_id')
            ->join('dostava', 'dostava_stavka.dostava_id', '=', 'dostava.id')
            ->whereIn('dostava_stavka.dostava_id', explode(',', $spiskovi))
            ->where('posiljka.posiljalac_id', $posiljalac_id)
            ->where('dostava_stavka.status', 2)
            ->select(
                'posiljka.*', 
                'dostava.radnik', 
                'dostava.broj_spiska', 
                'dostava_stavka.status as status_po_spisku', 
                'dostava_stavka.dostava_id',
                'dostava_stavka.deleted_at as stavka_obrisana'
            )
            // ->orderBy('posiljka.primalac_id', 'asc')
            // ->orderBy('dostava.radnik', 'asc')
            ->havingRaw('stavka_obrisana IS NULL')
            ->get();
        
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultParagraphStyle(array('align' => 'both', 'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0), 'spacing' => 0));
        $section = $phpWord->addSection(array('orientation' => 'landscape'));
        
        $header = array('size' => 16, 'bold' => true);
        $section->addText(htmlspecialchars('Pošiljalac: '.$posiljalac->naziv), $header);
        $section->addTextBreak(1);
        $section->addText(htmlspecialchars('ISPLATA URUČENIH POŠILJAKA - Datum od '.date('d.m.Y.', strtotime($datum_od ?? now())) .' do ' .date('d.m.Y.', strtotime($datum_do ?? now()))), $header);
        $section->addTextBreak(1);

        $styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80);
        $styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '000000');
        $styleCell = array('space' => array('line' => 1000));
        $fontStyle = array('bold' => true, 'align' => 'center');
        $phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
        $table = $section->addTable('Fancy Table');

        $table->addRow();
        $table->addCell(500, $styleCell)->addText(htmlspecialchars('R.B.'), $fontStyle);
        $table->addCell(3000, $styleCell)->addText(htmlspecialchars('PRIMALAC'), $fontStyle);
        // $table->addCell(3000, $styleCell)->addText(htmlspecialchars('RADNIK'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('BROJ POŠILJKE'), $fontStyle);
        $table->addCell(3000, $styleCell)->addText(htmlspecialchars('NAČIN PLAĆANJA'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('IZNOS'), $fontStyle);
        $table->addCell(2500, $styleCell)->addText(htmlspecialchars('NAPOMENA'), $fontStyle);

        $rb = 1;
        $za_isplatu = 0;
        foreach ($posiljke as $stavka) {
            if ((float) $stavka->vrednost > 0) {
                $za_isplatu += (float) $stavka->vrednost;
                $stavka_vrednost = number_format($stavka->vrednost, 2);

                if ($stavka->nacin_placanja_id == 2 || $stavka->nacin_placanja_id == 4) {
                    $za_isplatu += (float) $stavka->postarina;
                    $stavka_vrednost .= ' + ' . number_format($stavka->postarina, 2);
                }

                $table->addRow();

                $c1 = $table->addCell(500);
                $c1->addText(htmlspecialchars($rb));
    
                $c2 = $table->addCell(3000);
                $c2->addText(htmlspecialchars($stavka->primalac->naziv));
                //$c2->addText(htmlspecialchars($stavka->primalac->kontakt_telefon));
    
                // $cr = $table->addCell(3000);
                // $cr->addText(htmlspecialchars($stavka->radnik));
                
                $c3 = $table->addCell(2000);
                $c3->addText(htmlspecialchars($stavka->broj_posiljke));

                $c4 = $table->addCell(3000);
                $c4->addText(htmlspecialchars(strtoupper($stavka->nacinPlacanja->naziv)));
    
                $c5 = $table->addCell(2000);
                $c5->addText(htmlspecialchars($stavka_vrednost));
                
                $c6 = $table->addCell(2500);
                $c6->addText(htmlspecialchars(''));

                $rb++;
            }
        }

        $table->addRow();

        $c1 = $table->addCell(500);
        $c1->addText(htmlspecialchars(''));

        $c2 = $table->addCell(3000);
        $c2->addText(htmlspecialchars(''));
        //$c2->addText(htmlspecialchars($stavka->primalac->kontakt_telefon));

        // $cr = $table->addCell(3000);
        // $cr->addText(htmlspecialchars(''));
        
        $c3 = $table->addCell(2000);
        $c3->addText(htmlspecialchars(''));

        $c4 = $table->addCell(3000);
        $c4->addText(htmlspecialchars('UKUPNO'));

        $c5 = $table->addCell(2000);
        $c5->addText(htmlspecialchars(number_format($za_isplatu, 2)));
        
        $c6 = $table->addCell(2500);
        $c6->addText(htmlspecialchars(''));

        $section->addTextBreak(1);
        $section->addText(htmlspecialchars('Datum isplate: '.date('d.m.Y.')));
        $section->addTextBreak(1);
        $section->addText(htmlspecialchars('Potpis korisnika: '));

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path(date('Y-m-d').'_'.$posiljalac->naziv.'.docx'));
        } catch (\Exception $e) {
            dd($e);
        }

        return response()->download(storage_path(date('Y-m-d').'_'.$posiljalac->naziv.'.docx'))->deleteFileAfterSend(true);
    }

    public function spiskoviPoPosiljaocuSvi(Request $request)
    {
        //dd($request->all());
        $posiljaoci = PosiljalacPrimalac::whereIn('id', explode(',',$request->posiljaoci))->get();
        
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultParagraphStyle(array('align' => 'both', 'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0), 'spacing' => 0));
        $section = $phpWord->addSection(array('orientation' => 'landscape'));

        foreach ($posiljaoci as $key => $po) {
            $posiljke = Posiljka::with(['primalac', 'nacinPlacanja'])
            ->join('dostava_stavka', 'posiljka.id', '=', 'dostava_stavka.posiljka_id')
            ->join('dostava', 'dostava_stavka.dostava_id', '=', 'dostava.id')
            ->whereIn('dostava_stavka.dostava_id', explode(',', $request->spiskovi))
            ->where('posiljka.posiljalac_id', $po->id)
            ->where('dostava_stavka.status', 2)
            ->select(
                'posiljka.*', 
                'dostava.radnik', 
                'dostava.broj_spiska', 
                'dostava_stavka.status as status_po_spisku', 
                'dostava_stavka.dostava_id',
                'dostava_stavka.deleted_at as stavka_obrisana'
            )
            // ->orderBy('posiljka.primalac_id', 'asc')
            // ->orderBy('dostava.radnik', 'asc')
            ->havingRaw('stavka_obrisana IS NULL')
            ->get();
            
            $header = array('size' => 16, 'bold' => true);
            $section->addText(htmlspecialchars('Pošiljalac: '.$po->naziv), $header);
            $section->addTextBreak(1);
            $section->addText(htmlspecialchars('ISPLATA URUČENIH POŠILJAKA - Datum od '.date('d.m.Y.', strtotime(request()->date_from ?? now())) .' do ' .date('d.m.Y.', strtotime(request()->date_to ?? now()))), $header);
            $section->addTextBreak(1);
    
            $styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80);
            $styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '000000');
            $styleCell = array('space' => array('line' => 1000));
            $fontStyle = array('bold' => true, 'align' => 'center');
            $phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
            $table = $section->addTable('Fancy Table');
    
            $table->addRow();
            $table->addCell(500, $styleCell)->addText(htmlspecialchars('R.B.'), $fontStyle);
            $table->addCell(3000, $styleCell)->addText(htmlspecialchars('PRIMALAC'), $fontStyle);
            // $table->addCell(3000, $styleCell)->addText(htmlspecialchars('RADNIK'), $fontStyle);
            $table->addCell(2000, $styleCell)->addText(htmlspecialchars('BROJ POŠILJKE'), $fontStyle);
            $table->addCell(3000, $styleCell)->addText(htmlspecialchars('NAČIN PLAĆANJA'), $fontStyle);
            $table->addCell(2000, $styleCell)->addText(htmlspecialchars('IZNOS'), $fontStyle);
            $table->addCell(2500, $styleCell)->addText(htmlspecialchars('NAPOMENA'), $fontStyle);
    
            $rb = 1;
            $za_isplatu = 0;
            foreach ($posiljke as $stavka) {
                if ((float) $stavka->vrednost > 0) {
                    $za_isplatu += (float) $stavka->vrednost;
                    $stavka_vrednost = number_format($stavka->vrednost, 2);

                    if ($stavka->nacin_placanja_id == 2 || $stavka->nacin_placanja_id == 4) {
                        $za_isplatu += (float) $stavka->postarina;
                        $stavka_vrednost .= ' + ' . number_format($stavka->postarina, 2);
                    }

                    $table->addRow();
    
                    $c1 = $table->addCell(500);
                    $c1->addText(htmlspecialchars($rb));
        
                    $c2 = $table->addCell(3000);
                    $c2->addText(htmlspecialchars($stavka->primalac->naziv));
                    //$c2->addText(htmlspecialchars($stavka->primalac->kontakt_telefon));
        
                    // $cr = $table->addCell(3000);
                    // $cr->addText(htmlspecialchars($stavka->radnik));
                    
                    $c3 = $table->addCell(2000);
                    $c3->addText(htmlspecialchars($stavka->broj_posiljke));

                    $c4 = $table->addCell(3000);
                    $c4->addText(htmlspecialchars(strtoupper($stavka->nacinPlacanja->naziv)));
        
                    $c5 = $table->addCell(2000);
                    $c5->addText(htmlspecialchars($stavka_vrednost));
                    
                    $c6 = $table->addCell(2500);
                    $c6->addText(htmlspecialchars(''));

                    $rb++;
                }
            }
    
            $table->addRow();
    
            $c1 = $table->addCell(500);
            $c1->addText(htmlspecialchars(''));
    
            $c2 = $table->addCell(3000);
            $c2->addText(htmlspecialchars(''));
            //$c2->addText(htmlspecialchars($stavka->primalac->kontakt_telefon));
    
            // $cr = $table->addCell(3000);
            // $cr->addText(htmlspecialchars(''));
            
            $c3 = $table->addCell(2000);
            $c3->addText(htmlspecialchars(''));

            $c4 = $table->addCell(3000);
            $c4->addText(htmlspecialchars('UKUPNO'));
    
            $c5 = $table->addCell(2000);
            $c5->addText(htmlspecialchars(number_format($za_isplatu, 2)));
            
            $c6 = $table->addCell(2500);
            $c6->addText(htmlspecialchars(''));
    
            $section->addTextBreak(1);
            $section->addText(htmlspecialchars('Datum isplate: '.date('d.m.Y.', strtotime($request->datum))));
            $section->addTextBreak(1);
            $section->addText(htmlspecialchars('Potpis korisnika: '));

            if ($key != ($posiljaoci->count() -1 )) {
                $section->addPageBreak();
            }
        }
        
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path($request->datum.'_'.'.docx'));
        } catch (\Exception $e) {
            dd($e);
        }

        return response()->download(storage_path($request->datum.'_'.'.docx'))->deleteFileAfterSend(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dostava = Dostava::with([
            'stavke',
            'stavke.posiljalac',
            'stavke.posiljalac.ulica',
            'stavke.posiljalac.naselje',
            'stavke.primalac',
            'stavke.primalac.ulica',
            'stavke.primalac.naselje',
            'stavke.vrstaUsluge',
            'stavke.nacinPlacanja',
            'stavke.firma'
        ])->find($id);

        $posiljkeDostave = $dostava->stavke->pluck('id')->toArray();

        $posiljke = Posiljka::where(function ($q) use ($dostava) {
            $q->whereRaw('date(created_at) <= ?', [Carbon::parse($dostava->za_datum)->format('Y-m-d')]);
            $q->where('interna', 1);
        })
        ->orWhereIn('id', $posiljkeDostave)
        ->select(['id', 'broj_posiljke'])
        ->addSelect(DB::raw('
            (SELECT COUNT(*) 
                FROM dostava_stavka 
                WHERE dostava_stavka.posiljka_id = posiljka.id AND 
                (
                    SELECT COUNT(*)
                    FROM dostava 
                    WHERE dostava_stavka.dostava_id = dostava.id 
                    AND dostava.status = 0
                    AND dostava.deleted_at IS NULL
                )
                AND dostava_stavka.deleted_at IS NULL
            ) AS postoji_na_zaduzenom_spisku'))
        ->addSelect(DB::raw(
            '(
                SELECT COUNT(*) 
                FROM dostava_stavka
                WHERE dostava_stavka.posiljka_id = posiljka.id 
                AND dostava_stavka.status = 2
                AND dostava_stavka.deleted_at IS NULL
            ) AS urucen_status'
        ))
        ->addSelect(DB::raw(
            '(
                SELECT id
                FROM dostava_stavka
                WHERE dostava_stavka.dostava_id = '.$dostava->id.'
                AND dostava_stavka.posiljka_id = posiljka.id
                AND deleted_at IS NULL
            ) as ds_id'
        ))
        ->havingRaw('(urucen_status = 0 AND postoji_na_zaduzenom_spisku = 0) OR id IN ('.(count($posiljkeDostave) ? implode(',', $posiljkeDostave) : 0).')')
        ->orderBy('ds_id')
        ->get();

        //dd($posiljke);

        $mozeDaSeRazduzi = DostavaStavka::mozeDaSeRazduzi($id);

        return view('dostava.edit', compact('dostava', 'posiljke', 'posiljkeDostave', 'mozeDaSeRazduzi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dostava = Dostava::find($id);
        $dostava->broj_spiska = $request->broj_spiska;
        $dostava->radnik = $request->radnik;
        $dostava->za_datum = $request->datum;
        $dostava->save();

        if (!$dostava->status) {
            DB::transaction(function () use ($request, $dostava) {
                DostavaStavka::where('dostava_id', $dostava->id)->delete();
    
                if ($request->posiljke) {
                    foreach ($request->posiljke as $posiljka) {
                        $dostavaStavka = new DostavaStavka;
                        $dostavaStavka->dostava_id = $dostava->id;
                        $dostavaStavka->posiljka_id = $posiljka;

                        $status = DostavaStavka::
                            withTrashed()
                            ->where('posiljka_id', $posiljka)
                            ->where('dostava_id', $dostava->id)
                            ->orderBy('id', 'desc')
                            ->first();
                        
                        $dostavaStavka->status = $status ? $status->status : 0;
                        $dostavaStavka->save();
                    }
                }
            });
        }

        $dostava->za_naplatu = $dostava->stavke()->where('dostava_stavka.status', 2)->sum(DB::raw('posiljka.vrednost + posiljka.postarina'));
        
        $postarinaExtra = $dostava->stavke()
            ->where('dostava_stavka.status', 3)
            ->where('posiljka.nacin_placanja_id', 3)
            ->where('dostava_stavka.vracena', 1)
            ->sum(DB::raw('posiljka.postarina * 2'));

        $dostava->za_naplatu += $postarinaExtra;
        $dostava->save();
        
        return redirect()->route('cms.dostava.edit', $dostava);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dostava::findOrFail($id)->delete();

        return redirect()->route('cms.dostava.index');
    }

    public function proveraZaBrisanje($id)
    {
        $dostava = Dostava::find($id);
        return $dostava->stavke->count();
    }
}
