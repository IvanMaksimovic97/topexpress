<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dostava extends Model
{
    use SoftDeletes;

    protected $table = 'dostava';
    protected $guarded = [];

    public function stavke()
    {
        return $this->belongsToMany(Posiljka::class, 'dostava_stavka')->withPivot(['status as status_po_spisku', 'dostava_id as id_dostava', 'vracena as vracena_posiljka']);
    }
}
