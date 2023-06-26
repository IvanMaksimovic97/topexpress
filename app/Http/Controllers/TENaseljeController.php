<?php

namespace App\Http\Controllers;

use App\TEGrad;
use App\TENaselje;
use App\TEOpstina;
use Illuminate\Http\Request;

class TENaseljeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $naselja = TENaselje::with(['grad', 'opstina']);

        if (request()->search) {
            $naselja = $naselja->whereRaw('lower(naziv) LIKE ?', ['%'.strtolower(request()->search).'%']);
        }

        $naselja = $naselja->get();

        return view('te_naselje.index', compact('naselja'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $naselje = new TENaselje;
        $gradovi = TEGrad::all();
        $opstine = TEOpstina::all();

        return view('te_naselje.create', compact('naselje', 'gradovi', 'opstine'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $naselje = new TENaselje();
        $naselje->setValues();
        $naselje->save();

        return redirect()->route('cms.te_naselje.index')->withSuccess('Uspesno ste dodali grad');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TENaselje  $tENaselje
     * @return \Illuminate\Http\Response
     */
    public function show(TENaselje $tENaselje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TENaselje  $tENaselje
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $naselje = TENaselje::findOrFail($id);
        $gradovi = TEGrad::all();
        $opstine = TEOpstina::all();
        
        return view('te_naselje.edit', compact('naselje', 'gradovi', 'opstine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TENaselje  $tENaselje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $naselje = TENaselje::findOrFail($id);
        $naselje->setValues();
        $naselje->save();

        return redirect()->route('cms.te_naselje.index')->withSuccess('Uspesno ste dodali grad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TENaselje  $tENaselje
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $naselje = TENaselje::findOrFail($id);
        $naselje->delete();

        return response()->json(['msg' => 'Naselje je uspešno obrisano!']);
    }
}
