<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosiljkaBroj extends Model
{
    protected $table = 'posiljka_broj';
    protected $guarded = [];

    public static function poslednjiBroj()
    {
        return self::first();
    }

    public function setPoslednjiBroj()
    {
        $this->broj++;
        $broj_cifara = strlen($this->broj);
        $maksimalan_broj = 7;
        $broj_nula = $maksimalan_broj - $broj_cifara;

        $format = 'TE';

        while ($broj_nula > 0) {
            $format .= '0';
            $broj_nula--;
        }

        $format .= $this->broj . 'BG';
        
        $this->format = $format;
    }

    public static function povecajBroj()
    {
        $broj = self::first();
        $broj->broj++;
        $broj->save();
    }
}
