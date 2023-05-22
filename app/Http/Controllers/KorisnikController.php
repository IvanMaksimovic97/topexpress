<?php

namespace App\Http\Controllers;

use App\Korisnik;
use App\Naselje;
use App\PosiljalacPrimalac;
use App\Ulica;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class KorisnikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $korisnici = Korisnik::query();

        if (request()->search) {
            $korisnici = $korisnici->whereRaw('lower(ime) LIKE ?', ['%'.strtolower(request()->search).'%']);
            $korisnici = $korisnici->orWhereRaw('lower(prezime) LIKE ?', ['%'.strtolower(request()->search).'%']);
            //$korisnici = $korisnici->orWhereRaw('lower(jmbg) LIKE ?', ['%'.strtolower(request()->search).'%']);
            $korisnici = $korisnici->orWhereRaw('lower(email) LIKE ?', ['%'.strtolower(request()->search).'%']);
        }

        $korisnici = $korisnici->get();

        return view('korisnik.index', compact('korisnici'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $korisnik = new Korisnik;
        
        $ulice = Ulica::select('id', 'naziv')->groupBy(DB::raw('LOWER(naziv)'))->distinct()->get();
        $naselja = Naselje::select('id', 'naziv')->groupBy(DB::raw('LOWER(naziv)'))->distinct()->get();

        $posiljalac = new PosiljalacPrimalac;

        return view('korisnik.create', compact('korisnik', 'ulice', 'naselja', 'posiljalac'));
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
            'password' => 'required|confirmed',
            'naselje_id' => 'required',
            'ulica_id' => 'required'
        ],
        [
            'email.unique' => 'Korisnik sa unetim email-om već postoji!',
            'ime.required' => 'Ime je obavezno!',
            'prezime.required' => 'Ime je obavezno!',
            'password.required' => 'Lozinka je obavezna!',
            'password.confirmed' => 'Lozinke se ne poklapaju',
            'naselje_id.required' => 'Polje naselje je obavezno',
            'ulica_id.required' => 'Polje ulica je obavezno'
        ]);

        $korisnik = new Korisnik;
        $korisnik->email = $request->email;
        $korisnik->password = Hash::make($request->password);
        $korisnik->ime = $request->ime;
        $korisnik->prezime = $request->prezime;
        $korisnik->created_at = Carbon::now();
        $korisnik->status = $request->status ?? 0;
        $korisnik->pristup = $request->pristup;
        $korisnik->save();

        $naselje = Naselje::find($request->naselje_id);
        $ulica = Ulica::find($request->ulica_id);

        $posiljalac = new PosiljalacPrimalac;
        $posiljalac->naselje_id = $naselje ? $naselje->id : -1;
        $posiljalac->ulica_id = $ulica ? $ulica->id : -1;
        $posiljalac->naziv = $korisnik->ime . ' ' . $korisnik->prezime;
        $posiljalac->email = $korisnik->email;
        $posiljalac->naselje = $naselje ? $naselje->naziv : '';
        $posiljalac->ulica = $ulica ? $ulica->naziv : '';
        $posiljalac->broj = $request->broj ?? '';
        $posiljalac->podbroj = $request->podbroj ?? '';
        $posiljalac->sprat = $request->podbroj ?? '';
        $posiljalac->stan = $request->podbroj ?? '';
        $posiljalac->kontakt_telefon = $request->telefon ?? '';
        $posiljalac->save();

        return redirect()->route('cms.korisnik.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Korisnik  $korisnik
     * @return \Illuminate\Http\Response
     */
    public function show(Korisnik $korisnik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Korisnik  $korisnik
     * @return \Illuminate\Http\Response
     */
    public function edit(Korisnik $korisnik)
    {
        $ulice = Ulica::select('id', 'naziv')->groupBy(DB::raw('LOWER(naziv)'))->distinct()->get();
        $naselja = Naselje::select('id', 'naziv')->groupBy(DB::raw('LOWER(naziv)'))->distinct()->get();

        $posiljalac = PosiljalacPrimalac::where('email', $korisnik->email)->first();

        return view('korisnik.edit', compact('korisnik', 'ulice', 'naselja', 'posiljalac'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Korisnik  $korisnik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Korisnik $korisnik)
    {
        $request->validate([
            'ime' => 'required',
            'prezime' => 'required',
            'password' => 'confirmed',
            'naselje_id' => 'required',
            'ulica_id' => 'required'
        ],
        [
            'email.unique' => 'Korisnik sa unetim email-om već postoji!',
            'ime.required' => 'Ime je obavezno!',
            'prezime.required' => 'Ime je obavezno!',
            'password.confirmed' => 'Lozinke se ne poklapaju',
            'naselje_id.required' => 'Polje naselje je obavezno',
            'ulica_id.required' => 'Polje ulica je obavezno'
        ]);

        $email_check = Korisnik::where('email', $request->email)->where('id', '!=', $korisnik->id)->first();
        $msgBag = new MessageBag();

        if ($email_check) {
            $msgBag->add('email_error', 'Korisnik sa unetim email-om već postoji!');
            return redirect()->back()->withErrors($msgBag);
        }

        $korisnik = Korisnik::findOrFail($korisnik->id);
        $korisnik->email = $request->email;
        $korisnik->ime = $request->ime;
        $korisnik->prezime = $request->prezime;
        $korisnik->created_at = Carbon::now();
        $korisnik->status = $request->status ?? 0;
        $korisnik->pristup = $request->pristup;

        if ($request->password != '') {
            $korisnik->password = Hash::make($request->password);
        }

        $korisnik->save();

        $naselje = Naselje::find($request->naselje_id);
        $ulica = Ulica::find($request->ulica_id);

        $posiljalac = PosiljalacPrimalac::where('email', $korisnik->email)->first();

        if ($posiljalac) {
            $posiljalac->naselje_id = $naselje ? $naselje->id : -1;
            $posiljalac->ulica_id = $ulica ? $ulica->id : -1;
            $posiljalac->naziv = $korisnik->ime . ' ' . $korisnik->prezime;
            $posiljalac->email = $korisnik->email;
            $posiljalac->naselje = $naselje ? $naselje->naziv : '';
            $posiljalac->ulica = $ulica ? $ulica->naziv : '';
            $posiljalac->broj = $request->broj ?? '';
            $posiljalac->podbroj = $request->podbroj ?? '';
            $posiljalac->sprat = $request->podbroj ?? '';
            $posiljalac->stan = $request->podbroj ?? '';
            $posiljalac->kontakt_telefon = $request->telefon ?? '';
            $posiljalac->save();
        }
    
        return redirect()->route('cms.korisnik.edit', $korisnik)->withSuccess('Uspensa izmena!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Korisnik  $korisnik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Korisnik $korisnik)
    {
        //
    }
}
