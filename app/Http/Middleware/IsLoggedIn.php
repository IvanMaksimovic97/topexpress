<?php

namespace App\Http\Middleware;

use App\Korisnik;
use Closure;

class IsLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $korisnik = Korisnik::isLoggedIn();

        if (!$korisnik) {
            return redirect()->route('cms.login-front')->withErrors(['Morate biti prijavljeni!']);
        }

        //privremeno
        $ulogovani = Korisnik::ulogovanKorisnik();
        if ($ulogovani->uloga_id == 2) {
            Korisnik::logout();
            return redirect()->route('cms.login-front')->withErrors(['Niste vlasnik!']);
        }

        return $next($request);
    }
}
