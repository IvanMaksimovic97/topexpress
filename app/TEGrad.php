<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TEGrad extends Model
{
    use SoftDeletes;

    protected $table = 'te_grad';
    protected $guarded = [];

    public function setValues()
    {
        $request = request();

        $this->naziv = $request->naziv;
    }
}
