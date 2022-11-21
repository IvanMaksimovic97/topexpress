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
        // $korisnik = new Korisnik;
        // $korisnik->email = 'office@topexpress.rs';
        // $korisnik->password = Hash::make('topexpress2022');
        // $korisnik->ime = 'Duško';
        // $korisnik->prezime = 'Bosnić';
        // $korisnik->created_at = Carbon::now();
        // $korisnik->save();

        // $korisnik = new Korisnik;
        // $korisnik->email = 'sekularacs@gmail.com';
        // $korisnik->password = Hash::make('topexpress2022');
        // $korisnik->ime = 'Simo';
        // $korisnik->prezime = 'Šekularac';
        // $korisnik->created_at = Carbon::now();
        // $korisnik->save();

        // $korisnik = new Korisnik;
        // $korisnik->email = 'imaksimovic97@gmail.com';
        // $korisnik->password = Hash::make('topexpress2022');
        // $korisnik->ime = 'Ivan';
        // $korisnik->prezime = 'Maksimović';
        // $korisnik->created_at = Carbon::now();
        // $korisnik->save();

        $korisnik = new Korisnik;
        $korisnik->email = 'sasaradevic@topexpress.com';
        $korisnik->password = Hash::make('sasaradevic2022');
        $korisnik->ime = 'Saša';
        $korisnik->prezime = 'Radević';
        $korisnik->created_at = Carbon::now();
        $korisnik->pristup = 1;
        $korisnik->save();

        $korisnik = new Korisnik;
        $korisnik->email = 'sarajovanovic@topexpress.com';
        $korisnik->password = Hash::make('sarajovanovic2022');
        $korisnik->ime = 'Sara';
        $korisnik->prezime = 'Jovanović';
        $korisnik->created_at = Carbon::now();
        $korisnik->pristup = 1;
        $korisnik->save();

        $korisnik = new Korisnik;
        $korisnik->email = 'dejandrobnjak@topexpress.com';
        $korisnik->password = Hash::make('dejandrobnjak2022');
        $korisnik->ime = 'Dejan';
        $korisnik->prezime = 'Drobnjak';
        $korisnik->created_at = Carbon::now();
        $korisnik->pristup = 1;
        $korisnik->save();
    }
}
