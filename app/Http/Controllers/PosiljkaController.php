<?php

namespace App\Http\Controllers;

use App\Cenovnik;
use App\Dostava;
use App\Kompanija;
use App\NacinPlacanja;
use App\Naselje;
use App\PosiljalacPrimalac;
use App\Posiljka;
use App\PosiljkaBroj;
use App\Racun;
use App\Ulica;
use App\VrstaUsluge;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosiljkaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posiljke = Posiljka::with([
            'posiljalac',
            'posiljalac.ulica',
            'posiljalac.naselje',
            'primalac',
            'primalac.ulica',
            'primalac.naselje',
            'vrstaUsluge',
            'nacinPlacanja',
            'firma'
        ]);

        if (request()->search || request()->search_po || request()->search_pr) {
            if (request()->search) {
                $posiljke = $posiljke->whereRaw('lower(broj_posiljke) LIKE ?', ['%'.strtolower(request()->search.'%')]);
            }
            
            if (request()->search_po) {
                $posiljke = $posiljke->whereHas('posiljalac', function($q) {
                    $q->whereRaw('lower(posiljalac_primalac.naziv) LIKE ?', ['%'.strtolower(request()->search_po.'%')]);
                });
            }

            if (request()->search_pr) {
                $posiljke = $posiljke->whereHas('primalac', function($q) {
                    $q->whereRaw('lower(posiljalac_primalac.naziv) LIKE ?', ['%'.strtolower(request()->search_pr.'%')]);
                });
            }
        } else {
            if (request()->date) {
                $posiljke = $posiljke->whereRaw('date(created_at) = ?', [Carbon::parse(request()->date)->format('Y-m-d')]);
            } else {
                $posiljke = $posiljke->whereRaw('date(created_at) = ?', [Carbon::now()->format('Y-m-d')]);
            }
        }

        $posiljke = $posiljke->get();
        
        return view('posiljka.index', compact('posiljke'));
    }

    public function updateStatus($id, $status)
    {
        $posiljka = Posiljka::findOrFail($id);
        $posiljka->status = $status;
        $posiljka->save();

        return response()->json(['message' => 'Uspešna izmena!']);
    }

    public function proveraBrojaPosiljke($broj)
    {
        $posiljka = Posiljka::where('broj_posiljke', $broj)->first();

        return $posiljka ? 1 : 0;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$posiljkaBroj = PosiljkaBroj::poslednjiBrojFormat();
        $vrste_usluga = VrstaUsluge::all(['id', 'naziv']);
        $nacini_placanja = NacinPlacanja::all(['id', 'naziv']);
        $kompanije = Kompanija::all(['id', 'naziv', 'naziv_pun']);
        $primalacPosiljalac = PosiljalacPrimalac::groupBy('naziv')->get();
        $naselja = Naselje::groupBy('naziv')->get();
        $ulice = Ulica::groupBy('naziv')->get();
        $racuni = Racun::all(['id', 'broj_racuna']);

        $posiljka = new Posiljka;

        return view('posiljka.create', compact(
            'posiljka',
            'vrste_usluga', 
            'nacini_placanja', 
            'kompanije', 
            'primalacPosiljalac', 
            'naselja', 
            'ulice',
            //'posiljkaBroj',
            'racuni'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kompanija = $request->firma_id ? Kompanija::find($request->firma_id) : new Kompanija;
        if (!$request->firma_id) {
            if ($request->ugovor) {
                $kompanija->setValues();
                $kompanija->save();
            }
        }
        
        $po_naselje = $request->po_naselje_id ? Naselje::find($request->po_naselje_id) : new Naselje;
        if (!$request->po_naselje_id) {
            $po_naselje->setValues($request->po_naselje);
            $po_naselje->save();
        }
        
        $pr_naselje = $request->pr_naselje_id ? Naselje::find($request->pr_naselje_id) : new Naselje;
        if (!$request->pr_naselje_id) {
            $pr_naselje->setValues($request->pr_naselje);
            $pr_naselje->save();
        }
        
        $po_ulica = $request->po_ulica_id ? Ulica::find($request->po_ulica_id) : new Ulica;
        if (!$request->po_ulica_id) {
            $po_ulica->setValues($request->po_ulica);
            $po_ulica->save();
        }
        
        $pr_ulica = $request->pr_ulica_id ? Ulica::find($request->pr_ulica_id) : new Ulica;
        if (!$request->pr_ulica_id) {
            $pr_ulica->setValues($request->pr_ulica);
            $pr_ulica->save();
        }

        $posiljalac = $request->posiljalac_id ? PosiljalacPrimalac::find($request->posiljalac_id) : new PosiljalacPrimalac;
        $posiljalac->posiljalacSetValues($po_naselje->id, $po_ulica->id);
        $posiljalac->save();

        $primalac = $request->primalac_id ? PosiljalacPrimalac::find($request->primalac_id) : new PosiljalacPrimalac;
        $primalac->primalacSetValues($pr_naselje->id, $pr_ulica->id);
        $primalac->save();

        $masa = floatval($request->masa_kg);
        $cena = Cenovnik::where([
            ['vrsta_usluge_id', $request->vrsta_usluge_id],
            ['min_kg', '<', $masa],
            ['max_kg', '>=', $masa]
        ])->first();

        $posiljka = new Posiljka;
        $posiljka->setValues($kompanija->id ?? -1, $posiljalac->id, $primalac->id, $cena ? $cena->cena_sa_pdv : 0);
        $posiljka->save();

        if ($request->broj_racuna != null && $request->broj_racuna != '') {
            $racunPostoji = Racun::where('broj_racuna', $request->broj_racuna)->first();

            if (!$racunPostoji) {
                Racun::insert([
                    'broj_racuna' => $request->broj_racuna,
                    'created_at' => Carbon::now()
                ]);
            }
        }
        
        return redirect()->route('cms.posiljka.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posiljka  $posiljka
     * @return \Illuminate\Http\Response
     */
    public function show(Posiljka $posiljka)
    {
        $barcodeImage = file_get_contents('https://barcode.tec-it.com/barcode.ashx?data='.$posiljka->broj_posiljke);
        file_put_contents($posiljka->broj_posiljke.'.jpg', $barcodeImage);

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection([
            'pageSizeH' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(6),
            'pageSizeW' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(3),
            'marginLeft' => 100, 
            'marginRight' => 100,
            'marginTop' => 500, 
            'marginBottom' => 500
        ]);

        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setName('Arial');
        $fontStyle->setSize(11);

        $description = "<w:r>
        <w:t><w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('POŠILJALAC:', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr></w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->posiljalac->naziv, 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->posiljalac->ulica." ".$posiljka->posiljalac->broj.($posiljka->posiljalac->podbroj != '' ? '('.$posiljka->posiljalac->podbroj.')' : '')."".($posiljka->posiljalac->stan != '' ? '/'.$posiljka->posiljalac->stan : ''), 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->posiljalac->naselje, 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->posiljalac->kontakt_telefon, 'UTF-8')."</w:t>
        <w:br/>
        <w:br/>
        <w:t><w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('PRIMALAC:', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr></w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->primalac->naziv, 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->primalac->ulica." ".$posiljka->primalac->broj.($posiljka->primalac->podbroj != '' ? '('.$posiljka->primalac->podbroj.')' : '')."".($posiljka->primalac->stan != '' ? '/'.$posiljka->primalac->stan : ''), 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->primalac->naselje, 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->primalac->kontakt_telefon, 'UTF-8')."</w:t>
        <w:br/>
        <w:br/>
        <w:t><w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('MASA: ', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr></w:t>
        <w:t>".mb_strtoupper($posiljka->masa_kg, 'UTF-8')." KG</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->sadrzina, 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".($posiljka->ima_otkupninu ? "<w:br/><w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('OTKUPNINA: ', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr>".$posiljka->otkupnina : '')."</w:t>
        <w:br/>
        <w:t>".((float) $posiljka->postarina > 0 ? "<w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('POŠTARINA: ', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr>".mb_strtoupper($posiljka->postarina, 'UTF-8') : '')."</w:t>
        <w:br/>
        <w:br/>
        <w:t><w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('POŠTARINU PLAĆA:', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr></w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->nacinPlacanja->naziv, 'UTF-8')."</w:t>
        </w:r>";

        // $footer = "<w:r>
        // <w:t>TOPEXPRESS 2022 DOO</w:t>
        // <w:br/>
        // <w:t>WWW.TOPEXPRESS.RS</w:t>
        // <w:br/>
        // <w:t>+381 11 77777 33</w:t>
        // <w:br/>
        // <w:t>+381 66 815 0 900</w:t>
        // </w:r>";

        $footer = "<w:r>
        <w:t>".date('d.m.Y.')."</w:t>
        </w:r>";

        $section->addImage($posiljka->broj_posiljke.'.jpg', array('align' => 'center', 'width' => 100));
        // $section->addText($posiljka->broj_posiljke, null, array('align' => 'center', 'bold' => true, 'size' => 11));
        $font = $section->addText($description);
        $section->addText($footer, null, array('align' => 'center', 'size' => 11));
        $font->setFontStyle($fontStyle);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path($posiljka->broj_posiljke.'.docx'));
        } catch (\Exception $e) {
            dd($e);
        }

        @unlink($posiljka->broj_posiljke.'.jpg');

        return response()->download(storage_path($posiljka->broj_posiljke.'.docx'))->deleteFileAfterSend(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posiljka  $posiljka
     * @return \Illuminate\Http\Response
     */
    public function edit(Posiljka $posiljka)
    {
        $vrste_usluga = VrstaUsluge::all(['id', 'naziv']);
        $nacini_placanja = NacinPlacanja::all(['id', 'naziv']);
        $kompanije = Kompanija::all(['id', 'naziv', 'naziv_pun']);
        $primalacPosiljalac = PosiljalacPrimalac::groupBy('naziv')->get();
        $naselja = Naselje::groupBy('naziv')->get();
        $ulice = Ulica::groupBy('naziv')->get();
        $racuni = Racun::all(['id', 'broj_racuna']);

        $spisak = Dostava::whereHas('stavke', function($q) use ($posiljka) {
            $q->where('dostava_stavka.posiljka_id', $posiljka->id);
        })->get();

        return view('posiljka.edit', compact(
            'posiljka',
            'vrste_usluga', 
            'nacini_placanja', 
            'kompanije', 
            'primalacPosiljalac', 
            'naselja', 
            'ulice',
            //'posiljkaBroj',
            'racuni',
            'spisak'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posiljka  $posiljka
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posiljka $posiljka)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posiljka  $posiljka
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posiljka $posiljka)
    {
        //
    }
}
