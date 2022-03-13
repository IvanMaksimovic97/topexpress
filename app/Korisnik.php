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

    public static function isLoggedIn()
    {
        return session()->has('korisnik');
    }

    public static function logout()
    {
        session()->forget('korisnik');
    }

    public static function ulogovanKorisnik()
    {
        return session()->get('korisnik');
    }
}
