<?php

namespace App\Http\Controllers;

use App\Cenovnik;
use App\Exports\PosiljkeEksportExcel;
use App\Imports\PosiljkeExcelImport;
use App\Kompanija;
use App\Korisnik;
use App\NacinPlacanja;
use App\Naselje;
use App\PosiljalacPrimalac;
use App\Posiljka;
use App\PosiljkaBroj;
use App\Racun;
use App\Ugovor;
use App\Ulica;
use App\VrstaUsluge;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SiteCMSController extends Controller
{
    public function posiljke()
    {
        $unete_posiljke = session()->get('unetePosiljke') ?? 'null';
        session()->forget('unetePosiljke');

        $vrste_usluga = VrstaUsluge::all();
        $nacini_placanja = NacinPlacanja::all();

        $posiljke = Posiljka::with([
            'posiljalac',
            'posiljalac.ulica',
            'posiljalac.naselje',
            'primalac',
            'primalac.ulica',
            'primalac.naselje',
            'vrstaUsluge',
            'nacinPlacanja',
            'firma',
            'vlasnik'
        ])
        ->join('posiljalac_primalac as pp', 'pp.id', '=', 'posiljka.primalac_id')
        ->join('vrsta_usluge as vu', 'vu.id', '=', 'posiljka.vrsta_usluge_id')
        ->join('nacin_placanja as np', 'np.id', '=', 'posiljka.nacin_placanja_id')
        ->select(
            'posiljka.*',
            'pp.naziv as primalac_naziv',
            'pp.naselje as primalac_naselje',
            'pp.ulica as primalac_ulica',
            'pp.created_at as primalac_created_at',
            'vu.naziv as vrsta_usluge_naziv',
            'vu.created_at as vrsta_usluge_created_at',
            'np.naziv as nacin_placanja_naziv',
            'np.created_at as nacin_placanja_created_at'
        );

        if (request()->search || 
            request()->search_po || 
            request()->search_pr
        ) {
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

            $izabran_bar_jedan_datum = false;
            if (request()->date_from) {
                $posiljke = $posiljke->whereRaw('date(posiljka.created_at) >= ?', [Carbon::parse(request()->date_from)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (request()->date_to) {
                $posiljke = $posiljke->whereRaw('date(posiljka.created_at) <= ?', [Carbon::parse(request()->date_to)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (!$izabran_bar_jedan_datum) {
                $posiljke = $posiljke->whereRaw('date(posiljka.created_at) = ?', [Carbon::now()->format('Y-m-d')]);
            }

        } else {
            $izabran_bar_jedan_datum = false;
            if (request()->date_from) {
                $posiljke = $posiljke->whereRaw('date(posiljka.created_at) >= ?', [Carbon::parse(request()->date_from)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (request()->date_to) {
                $posiljke = $posiljke->whereRaw('date(posiljka.created_at) <= ?', [Carbon::parse(request()->date_to)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (!$izabran_bar_jedan_datum) {
                $posiljke = $posiljke->whereRaw('date(posiljka.created_at) = ?', [Carbon::now()->format('Y-m-d')]);
            }
        }


        //Nova filtracija
        if (request()->search_mesto) {
            $posiljke = $posiljke->whereRaw('lower(pp.naselje) LIKE ?', ['%'.strtolower(request()->search_mesto.'%')]);
        }

        if (request()->search_adresa) {
            $posiljke = $posiljke->whereRaw('lower(pp.ulica) LIKE ?', ['%'.strtolower(request()->search_adresa.'%')]);
        }

        if (request()->licno_preuzimanje && request()->licno_preuzimanje != '-1') {
            $lp = 0;

            if (request()->licno_preuzimanje == 2) {
                $lp = 1;
            }

            $posiljke = $posiljke->where('licno_preuzimanje', $lp);
        }

        if (request()->vrste_usluga && request()->vrste_usluga != '-1') {
            $posiljke = $posiljke->where('vrsta_usluge_id', request()->vrste_usluga);
        }

        if (request()->nacini_placanja && request()->nacini_placanja != '-1') {
            $posiljke = $posiljke->where('nacin_placanja_id', request()->nacini_placanja);
        }
        //Nova filtracija kraj

        $posiljke = $posiljke->where('id_korisnik', Korisnik::ulogovanKorisnikSite()->id);

        if (request()->ids != null) {
            $ids = explode(',', request()->ids);
            $posiljke = $posiljke->whereIn('posiljka.id', $ids);
        }

        switch(request()->sortBy) {
            case '1' :
                $posiljke = $posiljke->orderBy('broj_posiljke', 'asc');
            break;
            case '2' :
                $posiljke = $posiljke->orderBy('broj_posiljke', 'desc');
            break;
            case '3' :
                $posiljke = $posiljke->orderBy('posiljka.created_at', 'asc');
            break;
            case '4' :
                $posiljke = $posiljke->orderBy('posiljka.created_at', 'desc');
            break;
            case '5' :
                $posiljke = $posiljke->orderBy('otkupnina', 'asc');
            break;
            case '6' :
                $posiljke = $posiljke->orderBy('otkupnina', 'desc');
            break;
            case '7' :
                $posiljke = $posiljke->orderBy('primalac_naziv', 'asc');
            break;
            case '8' :
                $posiljke = $posiljke->orderBy('primalac_naziv', 'desc');
            break;
            case '9' :
                $posiljke = $posiljke->orderBy('primalac_naselje', 'asc');
            break;
            case '10' :
                $posiljke = $posiljke->orderBy('primalac_naselje', 'desc');
            break;
            case '11' :
                $posiljke = $posiljke->orderBy('primalac_ulica', 'asc');
            break;
            case '12' :
                $posiljke = $posiljke->orderBy('primalac_ulica', 'desc');
            break;
            case '13' :
                $posiljke = $posiljke->orderBy('masa_kg', 'asc');
            break;
            case '14' :
                $posiljke = $posiljke->orderBy('masa_kg', 'desc');
            break;
            case '15' :
                $posiljke = $posiljke->orderBy('postarina', 'asc');
            break;
            case '16' :
                $posiljke = $posiljke->orderBy('postarina', 'desc');
            break;
            case '17' :
                $posiljke = $posiljke->orderBy('vrsta_usluge_naziv', 'asc');
            break;
            case '18' :
                $posiljke = $posiljke->orderBy('vrsta_usluge_naziv', 'desc');
            break;
            case '19' :
                $posiljke = $posiljke->orderBy('nacin_placanja_naziv', 'asc');
            break;
            case '20' :
                $posiljke = $posiljke->orderBy('nacin_placanja_naziv', 'desc');
            break;
            case '21' :
                $posiljke = $posiljke->orderBy('sadrzina', 'asc');
            break;
            case '22' :
                $posiljke = $posiljke->orderBy('sadrzina', 'desc');
            break;
            case '23' :
                $posiljke = $posiljke->orderBy('licno_preuzimanje', 'asc');
            break;
            case '24' :
                $posiljke = $posiljke->orderBy('licno_preuzimanje', 'desc');
            break;
        }

        //Sortiranje posiljki

        //Kraj sortiranja
        $posiljke = $posiljke->get();

        $posiljke = $posiljke->map(function ($posiljka, $key) {
            $status = $posiljka->statusi->first();
            $posiljka->status_po_spisku = $status ? $status->status : '-1';
            return $posiljka;
        });

        if (request()->status_posiljke && request()->status_posiljke != '-2') {
            $posiljke = $posiljke->where('status_po_spisku', request()->status_posiljke);
        }

        $sum_posiljka = new Posiljka;
        $sum_posiljka->primalac = (object) [
            'naziv' => '',
            'naselje' => '',
            'ulica' => '',
            'broj' => '',
            'podbroj' => '',
            'stan' => '',
            'sprat' => null,
            'kontakt_telefon' => ''
        ];
        $sum_posiljka->naziv = '';
        $sum_posiljka->masa_kg = 'UKUPNO';
        $sum_posiljka->otkupnina = 0;
        
        foreach ($posiljke as $p) {
            $sum_posiljka->otkupnina += (float) $p->otkupnina;
        }

        //$posiljke->push($sum_posiljka);

        //dd((request()->all()));

        if (request()->stampajadresnice) {
            Posiljka::$stampaj_kao_firma = true;
            return Posiljka::stampajAdresnice($posiljke);
        }

        if (request()->stampajspisak) {
            return Posiljka::stampajSpisak($posiljke, Korisnik::ulogovanKorisnikSite());
        }

        if (request()->exportexcel) {
            //dd('ulazi');
            return Excel::download(new PosiljkeEksportExcel($posiljke), 'posiljke.xlsx');
        }

        if (request()->stampajadresnicea4l){
            return Posiljka::stampajAdresniceA4($posiljke, 'site/adresnice_a4_landscape.docx');
        }

        if (request()->stampajadresnicea4){
            return Posiljka::stampajAdresniceA4($posiljke, 'site/adresnice_a4.docx');
        }
        
        return view('site.authorized.posiljke', compact('posiljke', 'sum_posiljka', 'vrste_usluga', 'nacini_placanja', 'unete_posiljke'));
    }

    public function posiljkaNova()
    {
        //$posiljkaBroj = PosiljkaBroj::poslednjiBrojFormat();
        $vrste_usluga = VrstaUsluge::all(['id', 'naziv']);
        $nacini_placanja = NacinPlacanja::all(['id', 'naziv']);
        // $kompanije = Kompanija::all(['id', 'naziv', 'naziv_pun']);
        // $primalacPosiljalac = PosiljalacPrimalac::groupBy('naziv')->get();
        // $naselja = Naselje::groupBy('naziv')->get();
        // $ulice = Ulica::groupBy('naziv')->get();
        // $racuni = Racun::all(['id', 'broj_racuna']);
        // $ugovori = Ugovor::with(['kompanija'])->get();

        // $ugovori->transform(function ($item) {
        //     $item->naslov = $item->kompanija->naziv . ' - ' . $item->broj_ugovora;
        //     return $item;
        // });

        $posiljka = new Posiljka;

        if (request()->has('prethodna')) {
            $posiljka = Posiljka::where('id_korisnik', Korisnik::ulogovanKorisnikSite()->id)->orderBy('id', 'desc')->first();
            $posiljka->firma_id = null;
            $posiljka->primalac_id = null;
            $posiljka->primalac = null;
            $posiljka->ima_vrednost = null;
            $posiljka->ima_otkupninu = null;
            $posiljka->vrednost = null;
            $posiljka->otkupnina = null;
            $posiljka->otkupnina_vrsta = null;
            $posiljka->broj_racuna = null;
            $posiljka->povratnica = null;
            $posiljka->licno_preuzimanje = null;
            $posiljka->sadrzina = null;
            $posiljka->napomena = null;
        }

        $moze_da_izmeni_broj = false;

        return view('site.authorized.nova_posiljka', compact(
            'posiljka',
            'vrste_usluga', 
            'nacini_placanja', 
            //'kompanije', 
            //'primalacPosiljalac', 
            //'naselja', 
            //'ulice',
            //'posiljkaBroj',
            //'racuni',
            //'ugovori',
            'moze_da_izmeni_broj'
        ));
    }

    public function posiljkaIzmena($id)
    {
        $posiljka = Posiljka::where('id', $id)->where('id_korisnik', Korisnik::ulogovanKorisnikSite()->id)->firstOrFail();

        $vrste_usluga = VrstaUsluge::all(['id', 'naziv']);
        $nacini_placanja = NacinPlacanja::all(['id', 'naziv']);
        // $kompanije = Kompanija::all(['id', 'naziv', 'naziv_pun']);
        // $primalacPosiljalac = PosiljalacPrimalac::groupBy('naziv')->get();
        // $naselja = Naselje::groupBy('naziv')->get();
        // $ulice = Ulica::groupBy('naziv')->get();
        // $racuni = Racun::all(['id', 'broj_racuna']);
        // $ugovori = Ugovor::with(['kompanija'])->get();

        // $ugovori->transform(function ($item) {
        //     $item->naslov = $item->kompanija->naziv . ' - ' . $item->broj_ugovora;
        //     return $item;
        // });

        //$spisak = DostavaStavka::with(['dostava'])->where('posiljka_id', $posiljka->id)->get();

        $moze_da_izmeni_broj = true;

        return view('site.authorized.izmena_posiljke', compact(
            'posiljka',
            'vrste_usluga', 
            'nacini_placanja', 
            //'kompanije', 
            //'primalacPosiljalac', 
            //'naselja', 
            //'ulice',
            //'posiljkaBroj',
            //'racuni',
            //'ugovori',
            'moze_da_izmeni_broj'
        ));
    }

    public function posiljkaNovaStore(Request $request)
    {
        //dd($request->all());
        // $postojiPosiljka = Posiljka::where('broj_posiljke', 'TE'.$request->broj_posiljke.'BG')->first();
        // if ($postojiPosiljka) {
        //     return redirect()->route('posiljke-nova-site', ['prethodna'])->with('errMsg', 'Pošiljka sa zadatim brojem već postoji!');
        // }

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
        $primalac->primalacSetValuesSite($pr_naselje, $pr_ulica->id);
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

            session()->put('rucna_postarina', floatval($request->postarina));
        } else {
            session()->remove('rucna_postarina');
        }

        $posiljalac = PosiljalacPrimalac::where('email', Korisnik::ulogovanKorisnikSite()->email)->first();
        $posiljkaBroj = PosiljkaBroj::first();

        $posiljka = new Posiljka;
        $posiljka->broj_posiljke = $posiljkaBroj->format;
        $posiljka->interna = 0;
        $posiljka->id_korisnik = Korisnik::ulogovanKorisnikSite()->id;

        $posiljka->setValues($request->firma_id ?? -1, $posiljalac->id, $primalac->id, $cena_konacna);
        //$posiljka->setBarCode();
        $posiljka->setBarCodeSDK();
        $posiljka->save();

        $posiljkaBroj->setPoslednjiBroj();
        $posiljkaBroj->save();

        if ($request->broj_racuna != null && $request->broj_racuna != '') {
            $racunPostoji = Racun::where('broj_racuna', $request->broj_racuna)->first();

            if (!$racunPostoji) {
                Racun::insert([
                    'broj_racuna' => $request->broj_racuna,
                    'created_at' => Carbon::now()
                ]);
            }
        }
        
        return redirect()->route('posiljke-site', ['date' => date('Y-m-d', strtotime($posiljka->created_at))]);
    }

    public function posiljkaIzmenaUpdate(Request $request, $id)
    {
        $posiljka = Posiljka::where('id', $id)->where('id_korisnik', Korisnik::ulogovanKorisnikSite()->id)->firstOrFail();
        
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
        $primalac->primalacSetValuesSite($pr_naselje, $pr_ulica->id);
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

        //$posiljka = new Posiljka;
        $posiljka->setValues($request->firma_id ?? -1, $posiljalac->id, $primalac->id, $cena_konacna, $posiljka->broj_posiljke);
        //$posiljka->setBarCode();
        $posiljka->setBarCodeSDK();
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
        
        return redirect()->route('posiljka-izmena-site', $posiljka);
    }

    public function izmenaFirmeEdit()
    {
        $korisnik = Korisnik::ulogovanKorisnikSite();
        $korisnik = Korisnik::find($korisnik->id);

        $kompanija = null;

        if ($korisnik->kompanija) {
            $kompanija = $korisnik->kompanija;
        } else {
            $kompanija = new Kompanija;
        }

        return view('site.authorized._form_moja_firma', compact('kompanija'));
    }

    public function izmenaFirmeUpdate(Request $request)
    {
        $korisnik = Korisnik::ulogovanKorisnikSite();
        $korisnik = Korisnik::find($korisnik->id);

        $kompanija = null;

        if ($korisnik->kompanija) {
            $kompanija = $korisnik->kompanija;
        } else {
            $kompanija = new Kompanija;
        }

        $kompanija->id_korisnik = $korisnik->id;
        $kompanija->naziv = $request->naziv;
        $kompanija->naziv_pun = $request->naziv_pun;
        $kompanija->pib = $request->pib;
        $kompanija->mbr = $request->mbr;
        $kompanija->adresa = $request->adresa;
        $kompanija->email = $request->email;
        $kompanija->websajt = $request->websajt;
        $kompanija->telefon = $request->telefon;
        $kompanija->mobilni = $request->mobilni;
        $kompanija->save();

        return redirect()->route('dashboard-site');
    }

    public function unosPosiljkiExcel()
    {
        return view('site.authorized.upload_excel');
    }

    public function unosPosiljkiExcelStore(Request $request)
    {
        if (!$request->hasFile('excel-file')) {
            echo "Fajl nije unet ili nije u ispravnom formatu!";
            exit;
        }

        session()->put('unetePosiljke', 0);

        Excel::import(new PosiljkeExcelImport, request()->file('excel-file'));

        return redirect()->route('posiljke-site');
    }
}
