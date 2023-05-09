<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TEUlica extends Model
{
    use SoftDeletes;

    protected $table = 'te_ulica';
    protected $guarded = [];

    public function opstina()
    {
        return $this->hasOne(TEOpstina::class, 'id', 'id_te_opstina');
    }

    public function grad()
    {
        return $this->hasOne(TEGrad::class, 'id', 'id_te_grad');
    }

    public function naselje()
    {
        return $this->hasOne(TENaselje::class, 'id', 'id_te_grad');
    }

    public function setValues()
    {
        $request = request();

        $this->naziv = $request->naziv;
        $this->id_te_grad = $request->id_te_grad;
        $this->id_te_opstina = $request->id_te_opstina;
        $this->id_te_naselje = $request->id_te_naselje;
    }
}
