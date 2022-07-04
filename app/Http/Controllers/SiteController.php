<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistracijaRequest;
use App\Korisnik;
use App\Naselje;
use App\Rules\GoogleRecaptchaRule;
use App\Ulica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        
    }

    public function prijava()
    {

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
