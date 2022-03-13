<?php

use App\NacinPlacanja;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NacinPlacanjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $podaci = [
            'Pošiljalac gotovinski',
            'Pošiljalac fakturom',
            'Primalac gotovinski',
            'Primalac fakturom',
            'Treće lice',
        ];

        DB::transaction(function() use ($podaci) {
            foreach ($podaci as $podatak) {
                $nacinPlacanja = new NacinPlacanja;
                $nacinPlacanja->naziv = $podatak;
                $nacinPlacanja->created_at = Carbon::now();
                $nacinPlacanja->save();
            }
        });
    }
}
