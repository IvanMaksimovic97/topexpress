<?php

use App\Cenovnik;
use Illuminate\Database\Seeder;

class CenovnikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $podaci = [
            ['vrsta_usluge_id' => 2, 'masa_kg' => 'Do 1 kg', 'min_kg' => 0, 'max_kg' => 1, 'cena_sa_pdv' => 230],
            ['vrsta_usluge_id' => 2, 'masa_kg' => '1-3 kg', 'min_kg' => 1, 'max_kg' => 3, 'cena_sa_pdv' => 290],
            ['vrsta_usluge_id' => 2, 'masa_kg' => '3-5 kg', 'min_kg' => 3, 'max_kg' => 5, 'cena_sa_pdv' => 370],
            ['vrsta_usluge_id' => 2, 'masa_kg' => '5-10 kg', 'min_kg' => 5, 'max_kg' => 10, 'cena_sa_pdv' => 480],
            ['vrsta_usluge_id' => 2, 'masa_kg' => '10-15 kg', 'min_kg' => 10, 'max_kg' => 15, 'cena_sa_pdv' => 590],
            ['vrsta_usluge_id' => 2, 'masa_kg' => '15-20 kg', 'min_kg' => 15, 'max_kg' => 20,'cena_sa_pdv' => 670],
            ['vrsta_usluge_id' => 2, 'masa_kg' => '20-30 kg', 'min_kg' => 20, 'max_kg' => 30, 'cena_sa_pdv' => 1100],
            ['vrsta_usluge_id' => 2, 'masa_kg' => '30-50 kg', 'min_kg' => 30, 'max_kg' => 50, 'cena_sa_pdv' => 1490],
            ['vrsta_usluge_id' => 1, 'masa_kg' => 'Do 2 kg', 'min_kg' => 0, 'max_kg' => 2, 'cena_sa_pdv' => 480],
            ['vrsta_usluge_id' => 1, 'masa_kg' => '2-5 kg', 'min_kg' => 2, 'max_kg' => 5, 'cena_sa_pdv' => 670],
            ['vrsta_usluge_id' => 1, 'masa_kg' => '5-10 kg', 'min_kg' => 5, 'max_kg' => 10, 'cena_sa_pdv' => 780],
            ['vrsta_usluge_id' => 1, 'masa_kg' => '10-20 kg', 'min_kg' => 10, 'max_kg' => 20, 'cena_sa_pdv' => 860],
        ];

        Cenovnik::insert($podaci);
    }
}
