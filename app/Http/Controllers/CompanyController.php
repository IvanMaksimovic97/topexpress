<?php

namespace App\Http\Controllers;

use App\Kompanija;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kompanije = Kompanija::select();

        if (request()->search) {
            $kompanije = $kompanije->whereRaw('lower(naziv) LIKE ?', ['%'.strtolower(request()->search.'%')]);
        }

        $kompanije = $kompanije->get();

        return view('kompanija.index', compact('kompanije'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kompanija = new Kompanija;

        return view('kompanija.create', compact('kompanija'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kompanija = new Kompanija;
        $kompanija->naziv = $request->naziv;
        $kompanija->naziv_pun = $request->naziv_pun;
        $kompanija->pib = $request->pib;
        $kompanija->mbr = $request->mbr;
        $kompanija->adresa = $request->adresa;
        $kompanija->email = $request->email;
        $kompanija->websajt = $request->websajt;
        $kompanija->telefon = $request->telefon;
        $kompanija->mobilni = $request->mobilni;
        $kompanija->status = 1;
        $kompanija->save();

        return redirect()->route('cms.kompanija.index');
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
        $kompanija = Kompanija::find($id);
        
        return view('kompanija.edit', compact('kompanija'));
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
        $kompanija = Kompanija::find($id);
        $kompanija->naziv = $request->naziv;
        $kompanija->naziv_pun = $request->naziv_pun;
        $kompanija->pib = $request->pib;
        $kompanija->mbr = $request->mbr;
        $kompanija->adresa = $request->adresa;
        $kompanija->email = $request->email;
        $kompanija->websajt = $request->websajt;
        $kompanija->telefon = $request->telefon;
        $kompanija->mobilni = $request->mobilni;
        $kompanija->status = 1;
        $kompanija->save();

        return redirect()->route('cms.kompanija.edit', $kompanija);
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
