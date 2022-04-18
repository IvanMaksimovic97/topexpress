<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DostavaBroj extends Model
{
    protected $table = 'dostava_broj';
    protected $guarded = [];

    public static function poslednjiBroj()
    {
        $broj = self::whereRaw('date(created_at) = ?', [Carbon::now()->format('Y-m-d')])->first();
        
        if (!$broj) {
            $broj = new self;
            $broj->broj = 1;
            $broj->save();
        }

        return $broj;
    }

    public static function poslednjiBrojFormat()
    {
        $broj = self::poslednjiBroj();
        $broj_cifara = strlen($broj->broj);
        $maksimalan_broj = 2;
        $broj_nula = $maksimalan_broj - $broj_cifara;

        $format = '';

        while ($broj_nula > 0) {
            $format .= '0';
            $broj_nula--;
        }

        $format .= $broj->broj;

        return $format;
    }

    public static function povecajBroj()
    {
        $broj = self::poslednjiBroj();
        $broj->broj++;
        $broj->save();
    }
}
