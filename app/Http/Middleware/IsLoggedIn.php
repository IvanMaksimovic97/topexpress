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

        return $next($request);
    }
}
