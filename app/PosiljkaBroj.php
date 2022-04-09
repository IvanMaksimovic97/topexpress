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

    public static function poslednjiBrojFormat()
    {
        $broj = self::first();
        $broj_cifara = strlen($broj->broj);
        $maksimalan_broj = 6;
        $broj_nula = $maksimalan_broj - $broj_cifara;

        $format = 'TE';

        while ($broj_nula > 0) {
            $format .= '0';
            $broj_nula--;
        }

        $format .= $broj->broj . 'BG';

        return $format;
    }

    public static function povecajBroj()
    {
        $broj = self::first();
        $broj->broj++;
        $broj->save();
    }
}
