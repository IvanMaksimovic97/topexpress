<?php

use App\VrstaUsluge;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VrstaUslugeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vrstaUsluge = new VrstaUsluge;
        $vrstaUsluge->naziv = 'Danas za danas';
        $vrstaUsluge->created_at = Carbon::now();
        $vrstaUsluge->save();

        $vrstaUsluge = new VrstaUsluge;
        $vrstaUsluge->naziv = 'Danas za sutra';
        $vrstaUsluge->created_at = Carbon::now();
        $vrstaUsluge->save();
    }
}
