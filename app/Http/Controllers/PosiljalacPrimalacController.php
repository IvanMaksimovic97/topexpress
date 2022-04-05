<?php

namespace App\Http\Controllers;

use App\PosiljalacPrimalac;
use Illuminate\Http\Request;

class PosiljalacPrimalacController extends Controller
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
     * @param  \App\PosiljalacPrimalac  $posiljalacPrimalac
     * @return \Illuminate\Http\Response
     */
    public function show(PosiljalacPrimalac $posiljalacPrimalac)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PosiljalacPrimalac  $posiljalacPrimalac
     * @return \Illuminate\Http\Response
     */
    public function edit(PosiljalacPrimalac $posiljalacPrimalac)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PosiljalacPrimalac  $posiljalacPrimalac
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosiljalacPrimalac $posiljalacPrimalac)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PosiljalacPrimalac  $posiljalacPrimalac
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosiljalacPrimalac $posiljalacPrimalac)
    {
        //
    }

    public function getPosiljaoci($ime = '')
    {
        return PosiljalacPrimalac::where('naziv', 'like', '%'.$ime.'%')->get();
    }
}
