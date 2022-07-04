<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Korisnik extends Model
{
    use SoftDeletes;

    protected $table = 'korisnik';
    protected $guarded = [];

    public static function login($korisnik)
    {
        session()->put('korisnik', $korisnik);
    }

    public static function loginSite($korisnik)
    {
        session()->put('korisnik-site', $korisnik);
    }

    public static function isLoggedIn()
    {
        return session()->has('korisnik');
    }

    public static function isLoggedInSite()
    {
        return session()->has('korisnik-site');
    }

    public static function logout()
    {
        session()->forget('korisnik');
    }

    public static function logoutSite()
    {
        session()->forget('korisnik-site');
    }

    public static function ulogovanKorisnik()
    {
        return session()->get('korisnik');
    }

    public static function ulogovanKorisnikSite()
    {
        return session()->get('korisnik-site');
    }
}
