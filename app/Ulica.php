<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ulica extends Model
{
    protected $table = 'ulica';
    protected $guarded = [];

    public function setValues($naziv)
    {
        $this->naziv = $naziv;
        $this->updated_at = Carbon::now();
    }
}
