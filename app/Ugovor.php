<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ugovor extends Model
{
    use SoftDeletes;

    protected $table = 'ugovor';
    protected $guarded = [];

    public function kompanija()
    {
        return $this->hasOne(Kompanija::class, 'id', 'kompanija_id');
    }

    public function getCenovnik()
    {
        $cenovnik = Cenovnik::where('ugovor_id', $this->id)->get();

        return $cenovnik;
    }

    public function deleteCenovnik()
    {
        Cenovnik::where('ugovor_id', $this->id)->delete();
    }

    public function setCenovnik()
    {
        $cenovnik = request()->red;

        if (!$cenovnik) {
            return;
        }
        
        foreach ($cenovnik as $stavka) {
            $cena = new Cenovnik;
            $cena->ugovor_id = $this->id;
            $cena->vrsta_usluge_id = intval($stavka['vrsta_usluge']);
            $cena->masa_kg = $stavka['opis'];
            $cena->min_kg = intval($stavka['min_kg']);
            $cena->max_kg = intval($stavka['max_kg']);
            $cena->cena_sa_pdv = floatval($stavka['cena']);
            $cena->save();
        }
    }
}
