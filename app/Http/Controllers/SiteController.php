<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistracijaRequest;
use App\Kompanija;
use App\Korisnik;
use App\Naselje;
use App\PosiljalacPrimalac;
use App\Rules\GoogleRecaptchaRule;
use App\Ulica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.index');
    }

    public function contact()
    {
        return view('site.contact');
    }

    public function cenovnik()
    {
        return view('site.cenovnik');
    }

    public function onama()
    {
        return view('site.about');
    }

    public function registracija()
    {
        $ulice = Ulica::select('id', 'naziv')->groupBy(DB::raw('LOWER(naziv)'))->distinct()->get();
        $naselja = Naselje::select('id', 'naziv')->groupBy(DB::raw('LOWER(naziv)'))->distinct()->get();
        
        return view('site.registracija', compact('ulice', 'naselja'));
    }

    public function validateEmail($email = '')
    {
        $korisnik = Korisnik::where('email', $email)->first();
        return response()->json(['postoji' => $korisnik ? true : false]);
    }

    public function registracijaPost(RegistracijaRequest $request)
    {
        $hash = md5(time());

        $korisnik = new Korisnik;
        $korisnik->ime = $request->ime;
        $korisnik->prezime = $request->prezime;
        $korisnik->email = $request->email;
        $korisnik->password = Hash::make($request->password);
        $korisnik->status = 0;
        $korisnik->pristup = 2;
        $korisnik->mail_hash = $hash;
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
        $posiljalac->broj = $request->broj;
        $posiljalac->podbroj = $request->podbroj ?? '';
        $posiljalac->sprat = $request->podbroj ?? '';
        $posiljalac->stan = $request->podbroj ?? '';
        $posiljalac->kontakt_telefon = $request->telefon;
        $posiljalac->save();

        if ($request->has('reg_firma')) {
            $firma = new Kompanija;
            $firma->id_korisnik = $korisnik->id;
            $firma->naziv = $request->naziv_firme ?? '';
            $firma->naziv_pun = $request->naziv_firme ?? '';
            $firma->pib = $request->pib ?? '';
            $firma->mbr = $request->mbr ?? '';
            $firma->adresa = $request->adresa ?? '';
            $firma->telefon = $request->telefon_firma ?? '';
            $firma->save();
        }

        $poruka = "Uspešna registracija, kliknite na link ispod kako biste aktivirali svoj nalog.<br><br>";
        $poruka .= "<a href='".route('aktivacija-naloga', $hash)."'>".route('aktivacija-naloga', $hash)."</a>";

        Mail::send([], [], function ($msg) use ($request, $korisnik, $poruka) {
            $msg->from('info@topexpress.rs', 'Aktivacija naloga - TOP EXPRESS 2022 d.o.o.');
            $msg->to($korisnik->email);
            $msg->subject('Aktivacija naloga');
            $msg->setBody($poruka, 'text/html');
        });

        return redirect('/registracija')->with('success', 'Uspešna registracija! Proverite svoj email kako biste aktivirali nalog.');
    }

    public function aktivacijaNaloga($hash = '')
    {
        if ($hash != '') {
            $korisnik = Korisnik::where('mail_hash', $hash)->where('status', 0)->first();
            if ($korisnik) {
                $korisnik->mail_hash = '';
                $korisnik->status = 1;
                $korisnik->save();

                return redirect('/registracija')->with('success', 'Uspešna aktivacija naloga! Možete se ulogovati.');

            } else {
                return 'Link nije validan!';
            }
            
        } else {
            return 'Link nije validan!';
        }   
    }

    public function prijava(Request $request)
    {
        $request->validate([
            'email_login' => 'required|email',
            'password_login' => 'required'
        ], [
            'email_login.required' => 'Polje email je obavezno!',
            'email_login.email' => 'Polje email nije u ispravnom formatu!',
            'password_login.required' => 'Polje password je obavezno!'
        ]);

        $korisnik = Korisnik::where([
            ['email', $request->email_login],
            ['status', 1],
            ['pristup', 2]
        ])->first();

        if (!$korisnik || !Hash::check($request->password_login, $korisnik->password)) {
            Korisnik::logoutSite();
            return redirect('/registracija#myTabContent')->withErrors(['Pogrešni login podaci!']);
        }

        Korisnik::loginSite($korisnik);

        return redirect()->route('dashboard-site')->with('success', 'Dobro došli!');
    }

    public function dashboardSite()
    {
        return view('site.authorized.dashboard');
    }

    public function logoutSite()
    {
        Korisnik::logoutSite();
        return redirect()->route('registracija');
    }

    public function contactSendEmail(Request $request)
    {
        $poruka = "Ime: ".$request->name."<br>";
        $poruka .= "E-mail: ".$request->email."<br>";
        $poruka .= "Telefon: ".$request->telefon."<br>";
        $poruka .= "<br>".$request->message;

        // Mail::send([], [], function ($msg) use ($request, $poruka) {
        //     $msg->from('info@topexpress.rs', 'Kontakt poruka - TOP EXPRESS 2022 d.o.o.');
        //     $msg->to('office@topexpress.rs');
        //     $msg->subject($request->subject);
        //     $msg->setBody($poruka, 'text/html');
        // });
    }
}
