<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Naselje extends Model
{
    protected $table = 'naselje';
    protected $guarded = [];

    public function setValues($naziv)
    {
        $this->naziv = $naziv;
        $this->updated_at = Carbon::now();
    }
}
