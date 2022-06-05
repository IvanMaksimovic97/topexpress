<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function contactSendEmail(Request $request)
    {
        $poruka = "Ime: ".$request->name."<br>";
        $poruka .= "E-mail: ".$request->email."<br>";
        $poruka .= "Telefon: ".$request->telefon."<br>";
        $poruka .= "<br>".$request->message;

        Mail::send([], [], function ($msg) use ($request, $poruka) {
            $msg->from('info@topexpress.rs', 'Kontakt poruka - TOP EXPRESS 2022 d.o.o.');
            $msg->to('office@topexpress.rs');
            $msg->subject($request->subject);
            $msg->setBody($poruka, 'text/html');
        });
    }
}
