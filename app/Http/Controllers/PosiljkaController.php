<?php

namespace App\Http\Controllers;

use App\NacinPlacanja;
use App\Posiljka;
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
        return view('posiljka.index');
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
        return view('posiljka.create', compact('vrste_usluga', 'nacini_placanja'));
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
