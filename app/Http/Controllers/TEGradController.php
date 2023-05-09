<?php

namespace App\Http\Controllers;

use App\TEGrad;
use Illuminate\Http\Request;

class TEGradController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gradovi = TEGrad::query();

        if (request()->search) {
            $gradovi = $gradovi->whereRaw('lower(naziv) LIKE ?', ['%'.strtolower(request()->search).'%']);
        }

        $gradovi = $gradovi->get();

        return view('te_grad.index', compact('gradovi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grad = new TEGrad;

        return view('te_grad.create', compact('grad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grad = new TEGrad();
        $grad->setValues();
        $grad->save();

        return redirect()->route('cms.te_grad.index')->withSuccess('Uspesno ste dodali grad');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TEGrad  $tEGrad
     * @return \Illuminate\Http\Response
     */
    public function show(TEGrad $tEGrad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TEGrad  $tEGrad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grad = TEGrad::findOrFail($id);

        return view('te_grad.edit', compact('grad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TEGrad  $tEGrad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grad = TEGrad::findOrFail($id);
        $grad->setValues();
        $grad->save();

        return redirect()->route('cms.te_grad.index')->withSuccess('Uspesno ste dodali grad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TEGrad  $tEGrad
     * @return \Illuminate\Http\Response
     */
    public function destroy(TEGrad $tEGrad)
    {
        //
    }
}
