<?php

namespace App\Http\Controllers;

use App\TEUlica;
use Illuminate\Http\Request;

class TEUlicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ulice = TEUlica::query();

        if (request()->search) {
            $ulice = $ulice->whereRaw('lower(naziv) LIKE ?', ['%'.strtolower(request()->search).'%']);
        }

        $ulice = $ulice->get();

        return view('te_ulica.index', compact('ulice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ulica = new TEUlica;

        return view('te_ulica.create', compact('ulica'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ulica = new TEUlica();
        $ulica->setValues();
        $ulica->save();

        return redirect()->route('cms.te_ulica.index')->withSuccess('Uspesno ste dodali ulicu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TEUlica  $tEUlica
     * @return \Illuminate\Http\Response
     */
    public function show(TEUlica $tEUlica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TEUlica  $tEUlica
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ulica = TEUlica::findOrFail($id);
        
        return view('te_ulica.edit', compact('ulica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TEUlica  $tEUlica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ulica = TEUlica::findOrFail($id);
        $ulica->setValues();
        $ulica->save();

        return redirect()->route('cms.te_ulica.index')->withSuccess('Uspesno ste dodali ulicu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TEUlica  $tEUlica
     * @return \Illuminate\Http\Response
     */
    public function destroy(TEUlica $tEUlica)
    {
        //
    }
}
