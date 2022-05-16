<?php

namespace App\Http\Controllers;

use App\Cenovnik;
use Illuminate\Http\Request;

class CenovnikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cenovnik  $cenovnik
     * @return \Illuminate\Http\Response
     */
    public function show(Cenovnik $cenovnik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cenovnik  $cenovnik
     * @return \Illuminate\Http\Response
     */
    public function edit(Cenovnik $cenovnik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cenovnik  $cenovnik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cenovnik $cenovnik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cenovnik  $cenovnik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cenovnik $cenovnik)
    {
        //
    }

    public function dohvatiCenuPostarine($id_vrsta, $masa, $ugovor_id)
    {
        $masa = floatval($masa);
        $cena = Cenovnik::where([
            ['vrsta_usluge_id', $id_vrsta],
            ['ugovor_id', $ugovor_id],
            ['min_kg', '<', $masa],
            ['max_kg', '>=', $masa]
        ])->firstOrFail();
        return $cena->cena_sa_pdv;
    }
}
