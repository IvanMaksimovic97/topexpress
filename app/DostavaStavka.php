<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DostavaStavka extends Model
{
    use SoftDeletes;

    protected $table = 'dostava_stavka';
    protected $guarded = [];

    public function dostava()
    {
        return $this->hasOne(Dostava::class, 'id', 'dostava_id');
    }

    public function posiljka()
    {
        return $this->hasOne(Posiljka::class, 'id', 'posiljka_id');
    }

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
