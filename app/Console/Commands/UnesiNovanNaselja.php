<?php

namespace App\Console\Commands;

use App\TENaselje;
use Illuminate\Console\Command;

class UnesiNovanNaselja extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:unesinaselja';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $naselja = [
            [
                'naziv' => 'Arnajevo', 
                'postanski_broj' => '219108',
            ],
            ['naziv' => 'Barajevo', 'postanski_broj' => '11460'],
            ['naziv' => 'Baćevac', 'postanski_broj' => '218305'],
            ['naziv' => 'Beljina', 'postanski_broj' => '219001'],
            ['naziv' => 'Beli Potok', 'postanski_broj' => '11223'],
            ['naziv' => 'Zuce', 'postanski_broj' => '11225'],
            ['naziv' => 'Pinosava', 'postanski_broj' => '11226'],
            ['naziv' => 'Beograd(Vračar)', 'postanski_broj' => '11000'],
            ['naziv' => 'Begaljica', 'postanski_broj' => '11308'],
            ['naziv' => 'Boleč', 'postanski_broj' => '154111'],
            ['naziv' => 'Beograd(Zvezdara)', 'postanski_broj' => '11050'],
            ['naziv' => 'Beograd(Zemun)', 'postanski_broj' => '11080'],
            ['naziv' => 'Ugrinovci', 'postanski_broj' => '11277'],
            ['naziv' => 'Arapovac', 'postanski_broj' => '47240'],
            ['naziv' => 'Barzilovica', 'postanski_broj' => '11561'],
            ['naziv' => 'Baroševac', 'postanski_broj' => '11565'],
            ['naziv' => 'Velika Ivanča', 'postanski_broj' => '11414'],
            ['naziv' => 'Velika Krsna', 'postanski_broj' => '11408'],
            ['naziv' => 'Vlaška', 'postanski_broj' => '11406'],
            ['naziv' => 'Novi Beograd', 'postanski_broj' => '11070'],
            ['naziv' => 'Barič', 'postanski_broj' => '11504'],
            ['naziv' => 'Mala Moštanica', 'postanski_broj' => '11261'],
            ['naziv' => 'Mislođin', 'postanski_broj' => '11506'],
            ['naziv' => 'Beograd(Palilula)', 'postanski_broj' => '101801'],
            ['naziv' => 'Borča', 'postanski_broj' => '133308'],
            ['naziv' => 'Ovča', 'postanski_broj' => '11212'],
            ['naziv' => 'Beograd(Rakovica)', 'postanski_broj' => '11090'],
            ['naziv' => 'Beograd(Savski venac)', 'postanski_broj' => '11040'],
            ['naziv' => 'Sopot', 'postanski_broj' => '11450'],
            ['naziv' => 'Mala Ivanča', 'postanski_broj' => '227106'],
            ['naziv' => 'Mali Požarevac', 'postanski_broj' => '11235'],
            ['naziv' => 'Beograd(Stari grad)', 'postanski_broj' => '11000'],
            ['naziv' => 'Surčin', 'postanski_broj' => '11271'],
            ['naziv' => 'Jakovo', 'postanski_broj' => '11276'],
            ['naziv' => 'Dobanovci', 'postanski_broj' => '11272'],
            ['naziv' => 'Beograd(Čukarica)', 'postanski_broj' => '11030'],
            ['naziv' => 'Ostružnica', 'postanski_broj' => '11251'],
            ['naziv' => 'Sremčica', 'postanski_broj' => '11253']
        ];

        TENaselje::insert($naselja);
        
    }
}
