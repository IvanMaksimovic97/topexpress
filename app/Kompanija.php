<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kompanija extends Model
{
    use SoftDeletes;

    protected $table = 'kompanija';
    protected $guarded = [];
}
