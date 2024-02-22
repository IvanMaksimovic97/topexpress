<?php

namespace App\Console\Commands;

use App\Posiljka;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateBarKodPosiljke extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update_bar_kodovi';

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
        $posiljke = Posiljka::where('bar_kod', '')->get();

        //dd($posiljke);
        if (count($posiljke) == 0) {
            die('Nema vise posiljki!');
        }

        DB::transaction(function () use ($posiljke) {
            for ($i = 0; $i <= 2; $i++) {
                //$posiljke[$i]->setBarCode();
                $posiljke[$i]->setBarCodeSDK();
                $posiljke[$i]->save();
            }
        });
    }
}
