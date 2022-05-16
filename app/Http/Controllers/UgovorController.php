<?php

namespace App\Http\Controllers;

use App\Kompanija;
use App\Ugovor;
use App\VrstaUsluge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UgovorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ugovori = Ugovor::with(['kompanija']);

        if (request()->search) {
            $ugovori = $ugovori->whereRaw('lower(broj_ugovora) LIKE ?', ['%'.strtolower(request()->search.'%')]);
        }

        $ugovori = $ugovori->get();

        return view('ugovor.index', compact('ugovori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ugovor = new Ugovor;
        $kompanije = Kompanija::all(['id', 'naziv']);

        return view('ugovor.create', compact('ugovor', 'kompanije'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ugovor = new Ugovor;
        $ugovor->kompanija_id = $request->kompanija_id;
        $ugovor->broj_ugovora = $request->broj_ugovora;
        $ugovor->opis = $request->opis;
        $ugovor->pocetak = $request->pocetak;
        $ugovor->kraj = $request->kraj;
        $ugovor->save();

        $ugovor->deleteCenovnik();

        DB::transaction(function () use ($ugovor) {
            $ugovor->setCenovnik();
        });

        return redirect()->route('cms.ugovor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ugovor = Ugovor::find($id);
        $kompanije = Kompanija::all(['id', 'naziv']);

        return view('ugovor.edit', compact('ugovor', 'kompanije'));
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
        $ugovor = Ugovor::find($id);
        $ugovor->kompanija_id = $request->kompanija_id;
        $ugovor->broj_ugovora = $request->broj_ugovora;
        $ugovor->opis = $request->opis;
        $ugovor->pocetak = $request->pocetak;
        $ugovor->kraj = $request->kraj;
        $ugovor->save();

        $ugovor->deleteCenovnik();

        DB::transaction(function () use ($ugovor) {
            $ugovor->setCenovnik();
        });
        
        return redirect()->route('cms.ugovor.edit', $ugovor);
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
