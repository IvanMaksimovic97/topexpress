<?php

namespace App\Http\Controllers;

use App\Korisnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginFront()
    {
        return view('template.login');
    }

    public function loginBack(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $korisnik = Korisnik::where([
            ['email', $request->email],
            ['status', 1],
            ['pristup', 1]
        ])->first();

        if (!$korisnik || !Hash::check($request->password, $korisnik->password)) {
            Korisnik::logout();
            return redirect()->route('cms.login-front')->withErrors(['Pogrešni login podaci!']);
        }

        Korisnik::login($korisnik);

        return redirect()->route('cms.dashboard')->with('success', 'Dobro došli!');
    }

    public function logout()
    {
        Korisnik::logout();
        return redirect()->route('cms.login-front');
    }
}
