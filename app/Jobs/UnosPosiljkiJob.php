<?php

namespace App\Jobs;

use App\Korisnik;
use App\Naselje;
use App\PosiljalacPrimalac;
use App\Posiljka;
use App\PosiljkaBroj;
use App\Ulica;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UnosPosiljkiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $korisnik;
    public $posiljke;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($korisnik, $posiljke)
    {
        $this->korisnik = $korisnik;
        $this->posiljke = $posiljke;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //dd($this->korisnik, $this->posiljke);

        $count = 0;
        foreach ($this->posiljke as $item) {

            if($count == 0)
            {
                $count++;
                continue;
            } else {
                $count++;
            }

            if ($item[0] != null && 
                $item[1] != null && 
                $item[2] != null &&
                $item[3] != null &&
                $item[8] != null &&
                $item[10] != null &&
                $item[11] != null &&
                $item[12] != null
            ) {
                $posiljka = new Posiljka();
                $posiljka->interna = 0;
                $posiljka->id_korisnik = $this->korisnik->id;
                $posiljka->vrsta_usluge_id = 2;
                $posiljka->nacin_placanja_id = 1;
                $posiljka->firma_id = $this->korisnik->kompanija ? $this->korisnik->kompanija->id : -1;
    
                $posiljalac = PosiljalacPrimalac::where('email', $this->korisnik->email)->first();
                $posiljka->posiljalac_id = $posiljalac->id;
    
                $pr_naselje = Naselje::where('naziv', $item[1])->first();
                if (!$pr_naselje) {
                    $pr_naselje = new Naselje;
                    $pr_naselje->setValues($item[1]);
                    $pr_naselje->save();
                }
                
                $pr_ulica = Ulica::where('naziv', $item[2])->first();
                if (!$pr_ulica) {
                    $pr_ulica = new Ulica;
                    $pr_ulica->setValues($item[2]);
                    $pr_ulica->save();
                }
    
                $primalac = new PosiljalacPrimalac;
                $primalac->naselje_id = $pr_naselje->id;
                $primalac->ulica_id = $pr_ulica->id;
                $primalac->naziv = $item[0] ?? '';
                $primalac->email = $item[9] ?? '';
                $primalac->naselje = $pr_naselje->naziv ?? '';
                $primalac->ulica = $pr_ulica->naziv ?? '';
                $primalac->broj = $item[3] ?? '';
                $primalac->podbroj = $item[4] ?? '';
                $primalac->sprat = $item[5] ?? '';
                $primalac->stan = $item[6] ?? '';
                $primalac->napomena =  '';
                $primalac->kontakt_osoba = $item[7] ?? '';
                $primalac->kontakt_telefon = $item[8] ?? '';
                $primalac->save();
                
                $posiljka->primalac_id = $primalac->id;

                $brojPosiljke = PosiljkaBroj::first();
                $posiljka->broj_posiljke = $brojPosiljke->format;
                $brojPosiljke->setPoslednjiBroj();
                $brojPosiljke->save();
                
                $posiljka->broj_dolaznice = '';
                $posiljka->broj_racuna = '';
                $posiljka->ugovor = '';
                $posiljka->sadrzina = $item[12] ?? '';
                $posiljka->masa_kg = floatval($item[10]);
                $posiljka->ima_vrednost = floatval($item[11]) ? 1 : 0;
                $posiljka->vrednost = floatval($item[11]) ?? 0;
                $posiljka->ima_otkupninu = floatval($item[11]) ? 1 : 0;
                $posiljka->otkupnina = floatval($item[11]) ?? 0;
                $posiljka->povratnica = 0;
                $posiljka->licno_preuzimanje = 0;
                $posiljka->otkupnina_vrsta = 'TOP EXPRESS iznos';
                $posiljka->postarina = 0;
                $posiljka->created_at = date('Y-m-d H:i:s');
                $posiljka->setBarCode();
                $posiljka->save();

                if ($count > 101) {
                    break;
                }

                sleep(3);
            }
        }
    }
}
