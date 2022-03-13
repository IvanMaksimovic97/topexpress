<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Radnici extends Model
{
    use SoftDeletes;

    protected $table = 'radnici';
    protected $guarded = [];
}
