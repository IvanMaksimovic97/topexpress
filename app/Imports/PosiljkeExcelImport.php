<?php

namespace App\Imports;

use App\Jobs\UnosPosiljkiJob;
use App\Korisnik;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PosiljkeExcelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        UnosPosiljkiJob::dispatch(Korisnik::ulogovanKorisnikSite(), $collection);
    }
}
