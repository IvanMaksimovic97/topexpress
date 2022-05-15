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
}
