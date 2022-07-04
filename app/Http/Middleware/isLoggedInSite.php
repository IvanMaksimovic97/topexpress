<?php

namespace App\Http\Middleware;

use App\Korisnik;
use Closure;

class isLoggedInSite
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
        $korisnik = Korisnik::isLoggedInSite();

        if (!$korisnik) {
            return redirect()->route('registracija')->withErrors(['Morate biti prijavljeni!']);
        }

        //privremeno
        $ulogovani = Korisnik::ulogovanKorisnikSite();
        if ($ulogovani->uloga_id == 2) {
            Korisnik::logoutSite();
            return redirect()->route('registracija')->withErrors(['Niste vlasnik!']);
        }

        return $next($request);
    }
}
