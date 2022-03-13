<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posiljka extends Model
{
    use SoftDeletes;

    protected $table = 'posiljka';
    protected $guarded = [];
}
