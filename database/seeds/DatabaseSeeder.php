<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KorisnikSeeder::class);
        $this->call(VrstaUslugeSeeder::class);
        $this->call(NacinPlacanjaSeeder::class);
        $this->call(CenovnikSeeder::class);
    }
}
