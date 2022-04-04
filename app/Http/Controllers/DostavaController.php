<?php

namespace App\Http\Controllers;

use App\Dostava;
use App\Korisnik;
use App\Posiljka;
use App\View\Components\PosiljkaTabela;
use Illuminate\Http\Request;

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
        ])->get();

        //dd($spisak);

        return view('dostava.index', compact('spisak'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dostava = new Dostava;
        $posiljkeDostave = [];
        $posiljke = Posiljka::where('spisak_id', -1)->select(['id', 'broj_posiljke'])->get();
        return view('dostava.create', compact('posiljke', 'posiljkeDostave', 'dostava'));
    }

    public function posiljke($ids)
    {
        $posiljke = Posiljka::whereIn('id', explode(',', $ids))->get();
        $posiljkeComponent = new PosiljkaTabela($posiljke);
        return $posiljkeComponent->render()->render();
    }

    public function posiljkeUnete($id_dostava)
    {
        $posiljke = Posiljka::where('spisak_id', $id_dostava)->get();
        $posiljkeComponent = new PosiljkaTabela($posiljke);
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
        $dostava->za_naplatu = Posiljka::whereIn('id', $request->posiljke)->sum(\DB::raw('vrednost + postarina'));
        $dostava->save();

        Posiljka::whereIn('id', $request->posiljke)->update(['spisak_id' => $dostava->id]);

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
            $c4->addText(htmlspecialchars(($stavka->primalac->ulica.' '.$stavka->primalac->broj).''.($stavka->primalac->stan != '' ? '/'.$stavka->primalac->stan : '')));
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
        $posiljke = Posiljka::where('spisak_id', -1)->orWhereIn('id', $posiljkeDostave)->select(['id', 'broj_posiljke'])->get();
        
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
        $dostava->za_naplatu = Posiljka::whereIn('id', $request->posiljke)->sum(\DB::raw('vrednost + postarina'));
        $dostava->save();

        Posiljka::where('spisak_id', $id)->update(['spisak_id' => -1]);
        Posiljka::whereIn('id', $request->posiljke)->update(['spisak_id' => $dostava->id]);

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
