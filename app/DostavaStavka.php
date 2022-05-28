<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DostavaStavka extends Model
{
    use SoftDeletes;

    protected $table = 'dostava_stavka';
    protected $guarded = [];

    public static function mozeDaSeRazduzi($dostava_id)
    {
        $mozeDaSeRazduzi = self::where('dostava_id', $dostava_id)
        ->where(function ($q) {
            $q->where('status', 0);
            $q->orWhere('status', 1);
        })->first();

        if ($mozeDaSeRazduzi) {
            return false;
        } else {
            return true;
        }
    }
}
