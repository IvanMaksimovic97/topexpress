<?php

namespace App\Http\Controllers;

use App\Korisnik;
use App\Radnici;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class RadnikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $radnici = Radnici::select();

        if (request()->search) {
            $radnici = $radnici->whereRaw('lower(ime) LIKE ?', ['%'.strtolower(request()->search).'%']);
            $radnici = $radnici->orWhereRaw('lower(prezime) LIKE ?', ['%'.strtolower(request()->search).'%']);
            $radnici = $radnici->orWhereRaw('lower(jmbg) LIKE ?', ['%'.strtolower(request()->search).'%']);
            $radnici = $radnici->orWhereRaw('lower(email) LIKE ?', ['%'.strtolower(request()->search).'%']);
        }

        $radnici = $radnici->get();

        return view('radnik.index', compact('radnici'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $radnik = new Radnici;

        return view('radnik.create', compact('radnik'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'ime' => 'required',
            'prezime' => 'required',
            'email' => 'required|unique:korisnik,email',
            'jmbg' => 'required|unique:radnici,jmbg|digits:13'
        ],
        [
            'email.unique' => 'Radnik sa unetim email-om već postoji!',
            'jmbg.unique' => 'Radnik sa unetim JMBG-om već postoji!',
            'jmbg.digits' => 'JMBG mora imati 13 cifara!'
        ]);

        $korisnik = new Korisnik;
        $korisnik->email = $request->email;
        $korisnik->password = Hash::make('topexpress2022');
        $korisnik->ime = $request->ime;
        $korisnik->prezime = $request->prezime;
        $korisnik->uloga_id = 2;
        $korisnik->created_at = Carbon::now();
        $korisnik->save();

        $radnik = new Radnici;
        $radnik->korisnik_id = $korisnik->id;
        $radnik->ime = $korisnik->ime;
        $radnik->prezime = $korisnik->prezime;
        $radnik->jmbg = $request->jmbg;
        $radnik->email = $korisnik->email;
        $radnik->telefon = $request->telefon;
        $radnik->created_at = Carbon::now();
        $radnik->save();

        return redirect()->route('cms.radnik.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Radnici  $radnici
     * @return \Illuminate\Http\Response
     */
    public function show(Radnici $radnici)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Radnici  $radnici
     * @return \Illuminate\Http\Response
     */
    public function edit(Radnici $radnik)
    {
        return view('radnik.edit', compact('radnik'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Radnici  $radnici
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Radnici $radnik)
    {
        $request->validate([
            'ime' => 'required',
            'prezime' => 'required',
            'jmbg' => 'numeric|digits:13',
            'password' => 'confirmed'
        ],
        [
            'password.confirmed' => 'Lozinke se ne poklapaju!',
            'jmbg.max' => 'JMBG mora imati 13 cifara!'
        ]);

        $email_check = Korisnik::where('email', $request->email)->where('id', '!=', $radnik->korisnik_id)->first();
        $jmbg_check = Radnici::where('jmbg', $request->jmbg)->where('id', '!=', $radnik->id)->first();
        $msgBag = new MessageBag();

        if ($email_check) {
            $msgBag->add('email_error', 'Radnik sa unetim email-om već postoji!');
            return redirect()->back()->withErrors($msgBag);
        }
        
        if ($jmbg_check) {
            $msgBag->add('jmbg_error', 'Radnik sa unetim JMBG-om već postoji!');
            return redirect()->back()->withErrors($msgBag);
        }

        $korisnik = Korisnik::find($radnik->korisnik_id);
        $korisnik->email = $request->email;
        $korisnik->ime = $request->ime;
        $korisnik->prezime = $request->prezime;
        $korisnik->uloga_id = 2;
        $korisnik->updated_at = Carbon::now();

        if ($request->password != '') {
            $korisnik->password = Hash::make($request->password);
        }

        $korisnik->save();

        $radnik->korisnik_id = $korisnik->id;
        $radnik->ime = $korisnik->ime;
        $radnik->prezime = $korisnik->prezime;
        $radnik->jmbg = $request->jmbg;
        $radnik->email = $korisnik->email;
        $radnik->telefon = $request->telefon;
        $radnik->updated_at = Carbon::now();
        $radnik->save();

        return redirect()->route('cms.radnik.edit', $radnik)->withSuccess('Uspensa izmena!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Radnici  $radnici
     * @return \Illuminate\Http\Response
     */
    public function destroy(Radnici $radnici)
    {
        //
    }
}
