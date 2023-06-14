<?php

namespace App\Imports;

use App\TENaselje;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FirstSheetImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //dd('prvi', $collection);

        // foreach ($collection as $row) {
        //     if ($row[2] != null) {
        //         $naseljePostoji = TENaselje::where('naziv', $row[2])->first();

        //         if (!$naseljePostoji) {
        //             $naselje = new TENaselje;
        //             $naselje->naziv = $row[2];
        //             $naselje->save();
        //         }
        //     }
        // }
    }
}
