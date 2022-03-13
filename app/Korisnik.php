<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Korisnik extends Model
{
    use SoftDeletes;

    protected $table = 'korisnik';
    protected $guarded = [];
}
