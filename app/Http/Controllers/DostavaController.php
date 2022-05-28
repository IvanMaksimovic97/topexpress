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

        if (request()->date) {
            $spisak = $spisak->whereRaw('date(created_at) = ?', [Carbon::parse(request()->date)->format('Y-m-d')]);
        } else {
            $spisak = $spisak->whereRaw('date(created_at) = ?', [Carbon::now()->format('Y-m-d')]);
        }

        $spisak = $spisak->get();

        return view('dostava.index', compact('spisak'));
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
                    // ->where('status', '!=', 2)
                    ->select(['id', 'broj_posiljke'])
                    ->addSelect(DB::raw('
                        (SELECT COUNT(*) 
                            FROM dostava_stavka 
                            WHERE dostava_stavka.posiljka_id = posiljka.id AND 
                            (
                                SELECT COUNT(*) FROM dostava WHERE dostava_stavka.dostava_id = dostava.id AND dostava.status = 0
                            )
                        ) AS postoji_na_zaduzenom_spisku'))
                    ->addSelect(DB::raw(
                        '(
                            SELECT COUNT(*) 
                            FROM dostava_stavka
                            WHERE dostava_stavka.posiljka_id = posiljka.id AND dostava_stavka.status = 2
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

    public function posiljkeUnete($id_dostava)
    {
        $posiljke = Dostava::with(['stavke'])->where('id', $id_dostava)->first();
        $posiljkeComponent = new PosiljkaTabela($posiljke->stavke, $posiljke);
        $mozeDaSeRazduzi = DostavaStavka::mozeDaSeRazduzi($id_dostava);
        
        return response()->json([
            'html' => $posiljkeComponent->render()->render(), 
            'razduzi' => $mozeDaSeRazduzi, 
            'razduzen' => $posiljke->status
        ]);
    }

    public function razduzi($id)
    {
        $dostava = Dostava::with(['stavke'])->findOrFail($id);
        $dostava->status = 1;
        $dostava->za_naplatu = $dostava->stavke()->where('dostava_stavka.status', 2)->sum(DB::raw('posiljka.vrednost + posiljka.postarina'));
        $dostava->save();

        return redirect()->back();
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

            $adresa = $stavka->primalac->ulica.' '.$stavka->primalac->broj.''.($stavka->primalac->podbroj != '' ? '('.$stavka->primalac->podbroj.')' : '');
            if ($stavka->primalac->stan != '') {
                $adresa .= '/'.$stavka->primalac->stan;
            }

            $c4->addText(htmlspecialchars($adresa));

            if ($stavka->primalac->sprat) {
                $c4->addText(htmlspecialchars('Sprat: '.$stavka->primalac->sprat));
            }

            $c4->addText(htmlspecialchars($stavka->primalac->naselje));

            $c5 = $table->addCell(1500);
            $c5->addText(htmlspecialchars(number_format($stavka->vrednost + $stavka->postarina, 2, ',', '.')));

            $c6 = $table->addCell(2000)->addText(htmlspecialchars(''));
            $c7 = $table->addCell(1000)->addText(htmlspecialchars(''));
            $c8 = $table->addCell(2000)->addText(htmlspecialchars(''));

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
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('IZNOS'), $fontStyle);
        $table->addCell(2500, $styleCell)->addText(htmlspecialchars('NAPOMENA'), $fontStyle);

        $rb = 1;
        foreach ($dostava->stavke as $stavka) {
            $table->addRow();

            $c1 = $table->addCell(500);
            $c1->addText(htmlspecialchars($rb));

            $c2 = $table->addCell(3000);
            $c2->addText(htmlspecialchars($stavka->primalac->naziv));
            //$c2->addText(htmlspecialchars($stavka->primalac->kontakt_telefon));
            
            $c3 = $table->addCell(2000);
            $c3->addText(htmlspecialchars($stavka->broj_posiljke));

            $c4 = $table->addCell(2000);
            $c4->addText(htmlspecialchars(number_format($stavka->vrednost, 2)));
            
            $c5 = $table->addCell(2500);
            $c5->addText(htmlspecialchars(''));

            $rb++;
        }

        $table->addRow();

        $c1 = $table->addCell(500);
        $c1->addText(htmlspecialchars(''));

        $c2 = $table->addCell(3000);
        $c2->addText(htmlspecialchars(''));
        //$c2->addText(htmlspecialchars($stavka->primalac->kontakt_telefon));
        
        $c3 = $table->addCell(2000);
        $c3->addText(htmlspecialchars('UKUPNO'));

        $c4 = $table->addCell(2000);
        $c4->addText(htmlspecialchars(number_format($dostava->stavke->sum('vrednost'), 2)));
        
        $c5 = $table->addCell(2500);
        $c5->addText(htmlspecialchars(''));
        
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
            //$q->where('status', '!=', 1);
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
                    WHERE dostava_stavka.dostava_id = dostava.id AND dostava.status = 0
                )
            ) AS postoji_na_zaduzenom_spisku'))
        ->addSelect(DB::raw(
            '(
                SELECT COUNT(*) 
                FROM dostava_stavka
                WHERE dostava_stavka.posiljka_id = posiljka.id AND dostava_stavka.status = 2
            ) AS urucen_status'
        ))
        ->havingRaw('(urucen_status = 0 AND postoji_na_zaduzenom_spisku = 0) OR id IN ('.implode(',', $posiljkeDostave).')')
        ->orderBy('posiljka.id', 'desc')
        ->get();

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
        //$dostava->za_naplatu = Posiljka::whereIn('id', $request->posiljke ?? [])->where('status', 1)->sum(DB::raw('vrednost + postarina'));
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
        
        return redirect()->route('cms.dostava.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
