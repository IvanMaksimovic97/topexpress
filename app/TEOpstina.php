<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TEOpstina extends Model
{
    use SoftDeletes;

    protected $table = 'te_opstina';
    protected $guarded = [];

    public function grad()
    {
        return $this->hasOne(TEGrad::class, 'id', 'id_te_grad');
    }

    public function setValues()
    {
        $request = request();

        $this->naziv = $request->naziv;
        $this->id_te_grad = $request->id_te_grad;
    }
}
