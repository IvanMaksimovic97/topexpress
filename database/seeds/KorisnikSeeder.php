<?php

use App\Korisnik;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KorisnikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $korisnik = new Korisnik;
        $korisnik->email = 'office@topexpress.rs';
        $korisnik->password = Hash::make('topexpress2022');
        $korisnik->ime = 'Duško';
        $korisnik->prezime = 'Bosnić';
        $korisnik->created_at = Carbon::now();
        $korisnik->save();

        $korisnik = new Korisnik;
        $korisnik->email = 'sekularacs@gmail.com';
        $korisnik->password = Hash::make('topexpress2022');
        $korisnik->ime = 'Simo';
        $korisnik->prezime = 'Šekularac';
        $korisnik->created_at = Carbon::now();
        $korisnik->save();

        $korisnik = new Korisnik;
        $korisnik->email = 'imaksimovic97@gmail.com';
        $korisnik->password = Hash::make('topexpress2022');
        $korisnik->ime = 'Ivan';
        $korisnik->prezime = 'Maksimović';
        $korisnik->created_at = Carbon::now();
        $korisnik->save();
    }
}
