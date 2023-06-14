<?php

namespace App\Imports;

use App\TENaselje;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SecondSheetImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //dd('drugi', $collection);

        // foreach ($collection as $row) {
        //     if ($row[4] != null) {
        //         $naseljePostoji = TENaselje::where('naziv', $row[4])->first();

        //         if (!$naseljePostoji) {
        //             $naselje = new TENaselje;
        //             $naselje->naziv = $row[4];
        //             $naselje->save();
        //         }
        //     }
        // }
    }
}
