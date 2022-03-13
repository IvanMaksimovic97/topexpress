<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PosiljalacPrimalac extends Model
{
    use SoftDeletes;

    protected $table = 'posiljalac_primalac';
    protected $guarded = [];
}
