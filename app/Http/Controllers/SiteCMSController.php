<?php

namespace App\Http\Controllers;

use App\Cenovnik;
use App\Kompanija;
use App\Korisnik;
use App\NacinPlacanja;
use App\Naselje;
use App\PosiljalacPrimalac;
use App\Posiljka;
use App\Racun;
use App\Ugovor;
use App\Ulica;
use App\VrstaUsluge;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiteCMSController extends Controller
{
    public function posiljke()
    {
        $posiljke = Posiljka::with([
            'posiljalac',
            'posiljalac.ulica',
            'posiljalac.naselje',
            'primalac',
            'primalac.ulica',
            'primalac.naselje',
            'vrstaUsluge',
            'nacinPlacanja',
            'firma'
        ]);

        if (request()->search || request()->search_po || request()->search_pr) {
            if (request()->search) {
                $posiljke = $posiljke->whereRaw('lower(broj_posiljke) LIKE ?', ['%'.strtolower(request()->search.'%')]);
            }
            
            if (request()->search_po) {
                $posiljke = $posiljke->whereHas('posiljalac', function($q) {
                    $q->whereRaw('lower(posiljalac_primalac.naziv) LIKE ?', ['%'.strtolower(request()->search_po.'%')]);
                });
            }

            if (request()->search_pr) {
                $posiljke = $posiljke->whereHas('primalac', function($q) {
                    $q->whereRaw('lower(posiljalac_primalac.naziv) LIKE ?', ['%'.strtolower(request()->search_pr.'%')]);
                });
            }

            if (request()->date) {
                $posiljke = $posiljke->whereRaw('date(created_at) = ?', [Carbon::parse(request()->date)->format('Y-m-d')]);
            }

        } else {
            if (request()->date) {
                $posiljke = $posiljke->whereRaw('date(created_at) = ?', [Carbon::parse(request()->date)->format('Y-m-d')]);
            } else {
                $posiljke = $posiljke->whereRaw('date(created_at) = ?', [Carbon::now()->format('Y-m-d')]);
            }
        }

        $posiljke = $posiljke->where('id_korisnik', Korisnik::ulogovanKorisnikSite()->id);

        $posiljke = $posiljke->get();

        if (request()->stampajadresnice) {
            return Posiljka::stampajAdresnice($posiljke);
        }
        
        return view('site.authorized.posiljke', compact('posiljke'));
    }

    public function posiljkaNova()
    {
        //$posiljkaBroj = PosiljkaBroj::poslednjiBrojFormat();
        $vrste_usluga = VrstaUsluge::all(['id', 'naziv']);
        $nacini_placanja = NacinPlacanja::all(['id', 'naziv']);
        $kompanije = Kompanija::all(['id', 'naziv', 'naziv_pun']);
        $primalacPosiljalac = PosiljalacPrimalac::groupBy('naziv')->get();
        $naselja = Naselje::groupBy('naziv')->get();
        $ulice = Ulica::groupBy('naziv')->get();
        $racuni = Racun::all(['id', 'broj_racuna']);
        $ugovori = Ugovor::with(['kompanija'])->get();

        $ugovori->transform(function ($item) {
            $item->naslov = $item->kompanija->naziv . ' - ' . $item->broj_ugovora;
            return $item;
        });

        $posiljka = new Posiljka;

        if (request()->has('prethodna')) {
            $posiljka = Posiljka::orderBy('id', 'desc')->first();
        }

        return view('site.authorized.nova_posiljka', compact(
            'posiljka',
            'vrste_usluga', 
            'nacini_placanja', 
            'kompanije', 
            'primalacPosiljalac', 
            'naselja', 
            'ulice',
            //'posiljkaBroj',
            'racuni',
            'ugovori'
        ));
    }

    public function posiljkaNovaStore(Request $request)
    {
        $postojiPosiljka = Posiljka::where('broj_posiljke', $request->broj_posiljke)->first();
        if ($postojiPosiljka) {
            return redirect()->back()->with('errMsg', 'Pošiljka sa zadatim brojem već postoji!');
        }

        $pr_naselje = $request->pr_naselje_id ? Naselje::find($request->pr_naselje_id) : new Naselje;
        if (!$request->pr_naselje_id) {
            $pr_naselje->setValues($request->pr_naselje);
            $pr_naselje->save();
        }
        
        $pr_ulica = $request->pr_ulica_id ? Ulica::find($request->pr_ulica_id) : new Ulica;
        if (!$request->pr_ulica_id) {
            $pr_ulica->setValues($request->pr_ulica);
            $pr_ulica->save();
        }

        $primalac = $request->primalac_id ? PosiljalacPrimalac::find($request->primalac_id) : new PosiljalacPrimalac;
        $primalac->primalacSetValues($pr_naselje->id, $pr_ulica->id);
        $primalac->save();

        $masa = floatval($request->masa_kg);
        $cena = Cenovnik::where([
            ['vrsta_usluge_id', $request->vrsta_usluge_id],
            ['ugovor_id', $request->firma_id ?? -1],
            ['min_kg', '<', $masa],
            ['max_kg', '>=', $masa]
        ])->first();

        $cena_konacna = 0;

        if ($cena) {
            $cena_konacna = $cena->cena_sa_pdv;
        }

        if ($request->has('rucni_unos')) {
            $cena_konacna = floatval($request->postarina);
        }

        $posiljalac = PosiljalacPrimalac::where('email', Korisnik::ulogovanKorisnikSite()->email)->first();

        $posiljka = new Posiljka;
        $posiljka->setValues($request->firma_id ?? -1, $posiljalac->id, $primalac->id, $cena_konacna);
        $posiljka->setBarCode();
        $posiljka->save();

        if ($request->broj_racuna != null && $request->broj_racuna != '') {
            $racunPostoji = Racun::where('broj_racuna', $request->broj_racuna)->first();

            if (!$racunPostoji) {
                Racun::insert([
                    'broj_racuna' => $request->broj_racuna,
                    'created_at' => Carbon::now()
                ]);
            }
        }
        
        return redirect()->route('posiljke-site');
    }
}
