<?php

namespace App\Http\Controllers;

use App\Cenovnik;
use App\Kompanija;
use App\NacinPlacanja;
use App\Naselje;
use App\PosiljalacPrimalac;
use App\Posiljka;
use App\Ulica;
use App\VrstaUsluge;
use Illuminate\Http\Request;

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
        ])->get();
        
        //dd($posiljke);
        return view('posiljka.index', compact('posiljke'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vrste_usluga = VrstaUsluge::all(['id', 'naziv']);
        $nacini_placanja = NacinPlacanja::all(['id', 'naziv']);
        $kompanije = Kompanija::all(['id', 'naziv', 'naziv_pun']);
        $primalacPosiljalac = PosiljalacPrimalac::all();
        $naselja = Naselje::all(['id', 'naziv']);
        $ulice = Ulica::all(['id', 'naziv']);

        return view('posiljka.create', compact('vrste_usluga', 'nacini_placanja', 'kompanije', 'primalacPosiljalac', 'naselja', 'ulice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posiljka  $posiljka
     * @return \Illuminate\Http\Response
     */
    public function edit(Posiljka $posiljka)
    {
        //
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
