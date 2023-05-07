<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kompanija extends Model
{
    use SoftDeletes;

    protected $table = 'kompanija';
    protected $guarded = [];

    public function setValues()
    {
        $this->naziv = request()->ugovor ?? '';
        $this->updated_at = Carbon::now();
    }

    public function vlasnik()
    {
        return $this->hasOne(Korisnik::class, 'id', 'id_korisnik');
    }

    public function vlasnikNaziv()
    {
        $vlasnik = $this->vlasnik;

        return $vlasnik ? $vlasnik->ime . ' ' . $vlasnik->prezime : '';
    }
}
