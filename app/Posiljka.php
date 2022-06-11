<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posiljka extends Model
{
    use SoftDeletes;

    protected $table = 'posiljka';
    protected $guarded = [];

    public function posiljalac()
    {
        return $this->hasOne(PosiljalacPrimalac::class, 'id', 'posiljalac_id');
    }

    public function primalac()
    {
        return $this->hasOne(PosiljalacPrimalac::class, 'id', 'primalac_id');
    }

    public function vrstaUsluge()
    {
        return $this->hasOne(VrstaUsluge::class, 'id', 'vrsta_usluge_id');
    }

    public function nacinPlacanja()
    {
        return $this->hasOne(NacinPlacanja::class, 'id', 'nacin_placanja_id');
    }

    public function firma()
    {
        return $this->hasOne(Kompanija::class, 'id', 'firma_id');
    }

    public function dostave()
    {
        return $this->belongsToMany(Dostava::class, 'dostava_stavka');
    }

    public function setValues($firma_id, $posiljalac_id, $primalac_id, $postarina)
    {
        $this->vrsta_usluge_id = request()->vrsta_usluge_id;
        $this->nacin_placanja_id = request()->nacin_placanja_id;
        $this->firma_id = $firma_id;
        $this->posiljalac_id = $posiljalac_id;
        $this->primalac_id = $primalac_id;
        $this->broj_posiljke = request()->broj_posiljke ?? '';
        $this->broj_dolaznice = request()->broj_dolaznice ?? '';
        $this->broj_racuna = request()->broj_racuna ?? '';
        $this->ugovor = request()->ugovor ?? '';
        $this->sadrzina = request()->sadrzina ?? '';
        $this->masa_kg = floatval(request()->masa_kg);
        $this->ima_vrednost = request()->has('ima_vrednost') ? 1 : 0;
        $this->vrednost = request()->vrednost ?? 0;
        $this->ima_otkupninu = request()->has('ima_otkupninu') ? 1 : 0;
        $this->otkupnina = request()->otkupnina ?? 0;
        $this->povratnica = request()->has('povratnica') ? 1 : 0;
        $this->licno_preuzimanje = request()->has('licno_urucenje') ? 1 : 0;
        $this->otkupnina_vrsta = request()->has('otkupnina_vrsta') ? request()->otkupnina_vrsta : '';
        $this->postarina = $this->nacin_placanja_id == '1' ? 0 : $postarina;
        //$this->status = 0;
    }

    public function setBarCode()
    {
        @unlink($this->bar_kod);

        $barcodeImage = file_get_contents('https://barcode.tec-it.com/barcode.ashx?data='.$this->broj_posiljke);
        file_put_contents('storage/'.$this->broj_posiljke.'.jpg', $barcodeImage);

        $this->bar_kod = $this->broj_posiljke.'.jpg';
    }
}
