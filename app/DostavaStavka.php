<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DostavaStavka extends Model
{
    protected $table = 'dostava_stavka';
    protected $guarded = [];
}
