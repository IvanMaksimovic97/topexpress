<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DostavaStavka extends Model
{
    use SoftDeletes;

    protected $table = 'dostava_stavka';
    protected $guarded = [];
}
