<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PosiljalacPrimalac extends Model
{
    use SoftDeletes;

    protected $table = 'posiljalac_primalac';
    protected $guarded = [];

    public function ulica()
    {
        return $this->hasOne(Ulica::class, 'ulica_id', 'id');
    }

    public function naselje()
    {
        return $this->hasOne(Naselje::class, 'naselje_id', 'id');
    }
}
