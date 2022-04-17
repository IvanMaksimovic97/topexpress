<?php

namespace App\Http\Controllers;

use App\Dostava;
use App\DostavaStavka;
use App\Korisnik;
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

        if (request()->search) {
            $spisak = $spisak->whereRaw('lower(broj_spiska) LIKE ?', ['%'.strtolower(request()->search.'%')]);
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
        $brojDostave = Dostava::orderBy('id', 'desc')->first();
        
        if ($brojDostave == null) {
            $brojDostave = 1;
        } else {
            $brojDostave = (int) $brojDostave->id + 1;
        }

        $dostava = new Dostava;
        $posiljkeDostave = [];
        $posiljke = Posiljka::where('status', '!=', 1)->select(['id', 'broj_posiljke'])->get();
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
        $posiljkeComponent = new PosiljkaTabela($posiljke->stavke);
        return $posiljkeComponent->render()->render();
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
        $dostava->za_naplatu = Posiljka::whereIn('id', $request->posiljke ?? [])->where('status', 1)->sum(DB::raw('vrednost + postarina'));
        $dostava->save();

        if ($request->posiljke) {
            DB::transaction(function () use ($request, $dostava) {
                foreach ($request->posiljke as $posiljka) {
                    $dostavaStavka = new DostavaStavka;
                    $dostavaStavka->dostava_id = $dostava->id;
                    $dostavaStavka->posiljka_id = $posiljka;
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

            $adresa = $stavka->primalac->ulica.' '.$stavka->primalac->broj;
            if ($stavka->primalac->stan != '') {
                $adresa .= '/'.$stavka->primalac->stan;
            }

            $c4->addText(htmlspecialchars($adresa));

            if ($stavka->primalac->podbroj) {
                $c4->addText(htmlspecialchars('Podbroj: '.$stavka->primalac->podbroj));
            }

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
        $posiljke = Posiljka::where('status', '!=', -1)->orWhereIn('id', $posiljkeDostave)->select(['id', 'broj_posiljke'])->get();
        
        return view('dostava.edit', compact('dostava', 'posiljke', 'posiljkeDostave'));
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
        $dostava->za_naplatu = Posiljka::whereIn('id', $request->posiljke ?? [])->where('status', 1)->sum(DB::raw('vrednost + postarina'));
        $dostava->save();

        DB::transaction(function () use ($request, $dostava) {
            DostavaStavka::where('dostava_id', $dostava->id)->delete();

            if ($request->posiljke) {
                foreach ($request->posiljke as $posiljka) {
                    $dostavaStavka = new DostavaStavka;
                    $dostavaStavka->dostava_id = $dostava->id;
                    $dostavaStavka->posiljka_id = $posiljka;
                    $dostavaStavka->save();
                }
            }
        });

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
