<?php

namespace App\Http\Middleware;

use App\Korisnik;
use Closure;

class notLoggedInSite
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

        if ($korisnik) {
            return redirect()->route('dashboard-site');
        }

        return $next($request);
    }
}
