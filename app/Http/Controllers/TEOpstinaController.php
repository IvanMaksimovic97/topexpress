<?php

namespace App\Http\Controllers;

use App\TEGrad;
use App\TEOpstina;
use Illuminate\Http\Request;

class TEOpstinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opstine = TEOpstina::query();

        if (request()->search) {
            $opstine = $opstine->whereRaw('lower(naziv) LIKE ?', ['%'.strtolower(request()->search).'%']);
        }

        $opstine = $opstine->get();

        return view('te_opstina.index', compact('opstine'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opstina = new TEOpstina;
        $gradovi = TEGrad::all();

        return view('te_opstina.create', compact('opstina', 'gradovi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $opstina = new TEOpstina();
        $opstina->setValues();
        $opstina->save();

        return redirect()->route('cms.te_opstina.index')->withSuccess('Uspesno ste dodali grad');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TEOpstina  $tEOpstina
     * @return \Illuminate\Http\Response
     */
    public function show(TEOpstina $tEOpstina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TEOpstina  $tEOpstina
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $opstina = TEOpstina::findOrFail($id);
        $gradovi = TEGrad::all();
        
        return view('te_opstina.edit', compact('opstina', 'gradovi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TEOpstina  $tEOpstina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $opstina = TEOpstina::findOrFail($id);
        $opstina->setValues();
        $opstina->save();

        return redirect()->route('cms.te_opstina.index')->withSuccess('Uspesno ste dodali grad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TEOpstina  $tEOpstina
     * @return \Illuminate\Http\Response
     */
    public function destroy(TEOpstina $tEOpstina)
    {
        //
    }
}
