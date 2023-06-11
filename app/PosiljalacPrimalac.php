<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PosiljalacPrimalac extends Model
{
    use SoftDeletes;

    protected $table = 'posiljalac_primalac';
    protected $guarded = [];

    public function ulica()
    {
        return $this->hasOne(Ulica::class, 'id', 'ulica_id');
    }

    public function naselje()
    {
        return $this->hasOne(Naselje::class, 'id', 'naselje_id');
    }

    public function posiljalacSetValues($naselje_id, $ulica_id)
    {
        $this->naselje_id = $naselje_id;
        $this->ulica_id = $ulica_id;
        $this->naziv = request()->po_naziv ?? '';
        $this->email = request()->po_email ?? '';
        $this->naselje = request()->po_naselje ?? '';
        $this->ulica = request()->po_ulica ?? '';
        $this->broj = request()->po_broj ?? '';
        $this->podbroj = request()->po_podbroj ?? '';
        $this->sprat = request()->po_sprat ?? '';
        $this->stan = request()->po_stan ?? '';
        $this->napomena = request()->po_napomena ?? '';
        $this->kontakt_osoba = request()->po_kontakt_osoba ?? '';
        $this->kontakt_telefon = request()->po_kontakt_telefon ?? '';
    }

    public function primalacSetValues($naselje_id, $ulica_id)
    {
        $this->naselje_id = $naselje_id;
        $this->ulica_id = $ulica_id;
        $this->naziv = request()->pr_naziv ?? '';
        $this->email = request()->pr_email ?? '';
        $this->naselje = request()->pr_naselje ?? '';
        $this->ulica = request()->pr_ulica ?? '';
        $this->broj = request()->pr_broj ?? '';
        $this->podbroj = request()->pr_podbroj ?? '';
        $this->sprat = request()->pr_sprat ?? '';
        $this->stan = request()->pr_stan ?? '';
        $this->napomena = request()->pr_napomena ?? '';
        $this->kontakt_osoba = request()->pr_kontakt_osoba ?? '';
        $this->kontakt_telefon = request()->pr_kontakt_telefon ?? '';
    }

    public function primalacSetValuesSite($naselje, $ulica_id)
    {
        $this->naselje_id = $naselje->id;
        $this->ulica_id = $ulica_id;
        $this->naziv = request()->pr_naziv ?? '';
        $this->email = request()->pr_email ?? '';
        $this->naselje = $naselje->naziv ?? '';
        $this->ulica = request()->pr_ulica ?? '';
        $this->broj = request()->pr_broj ?? '';
        $this->podbroj = request()->pr_podbroj ?? '';
        $this->sprat = request()->pr_sprat ?? '';
        $this->stan = request()->pr_stan ?? '';
        $this->napomena = request()->pr_napomena ?? '';
        $this->kontakt_osoba = request()->pr_kontakt_osoba ?? '';
        $this->kontakt_telefon = request()->pr_kontakt_telefon ?? '';
    }
}
