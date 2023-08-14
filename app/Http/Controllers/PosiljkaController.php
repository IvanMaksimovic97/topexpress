<?php

namespace App\Http\Controllers;

use App\Cenovnik;
use App\Dostava;
use App\DostavaStavka;
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
use Illuminate\Support\Facades\DB;

class PosiljkaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
            'firma',
            'statusi'
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

            $izabran_bar_jedan_datum = false;
            if (request()->date_from) {
                $posiljke = $posiljke->whereRaw('date(created_at) >= ?', [Carbon::parse(request()->date_from)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (request()->date_to) {
                $posiljke = $posiljke->whereRaw('date(created_at) <= ?', [Carbon::parse(request()->date_to)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (!$izabran_bar_jedan_datum) {
                $posiljke = $posiljke->whereRaw('date(created_at) = ?', [Carbon::now()->format('Y-m-d')]);
            }

        } else {
            $izabran_bar_jedan_datum = false;
            if (request()->date_from) {
                $posiljke = $posiljke->whereRaw('date(created_at) >= ?', [Carbon::parse(request()->date_from)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (request()->date_to) {
                $posiljke = $posiljke->whereRaw('date(created_at) <= ?', [Carbon::parse(request()->date_to)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (!$izabran_bar_jedan_datum) {
                $posiljke = $posiljke->whereRaw('date(created_at) = ?', [Carbon::now()->format('Y-m-d')]);
            }
        }

        if (request()->nacin_placanja_id && request()->nacin_placanja_id != '-1') {
            $posiljke = $posiljke->where('nacin_placanja_id', request()->nacin_placanja_id);
        }

        $posiljke = $posiljke->where('interna', 1);
        $posiljke = $posiljke->get();

        if (request()->stampajadresnice) {
            return Posiljka::stampajAdresnice($posiljke);
        }

        if (request()->stampajspisak) {
            return Posiljka::stampajSpisak($posiljke);
        }

        $nacini_placanja = NacinPlacanja::all(['id', 'naziv']);

        $posiljke = $posiljke->map(function ($posiljka, $key) {
            $status = $posiljka->statusi->first();
            $posiljka->status_po_spisku = $status ? $status->status : '-1';
            return $posiljka;
        });

        if (request()->status_posiljke && request()->status_posiljke != '-2') {
            $posiljke = $posiljke->where('status_po_spisku', request()->status_posiljke);
        }

        $routeFilters = route('cms.posiljka.index');


        #Izvestaj po posiljaocu#
        $posiljkePoPosiljaocu = [];

        foreach ($posiljke as $p) {
            if (!array_key_exists($p->posiljalac_id, $posiljkePoPosiljaocu)) {
                $posiljkePoPosiljaocu[$p->posiljalac_id]['ime_prezime'] = $p->posiljalac->naziv;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['primljene']['broj'] = 0;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['primljene']['iznos'] = 0;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['urucene']['broj'] = 0;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['urucene']['iznos'] = 0;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['na_dostavi']['broj'] = 0;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['na_dostavi']['iznos'] = 0;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['vracene']['broj'] = 0;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['vracene']['iznos'] = 0;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['za_narednu']['broj'] = 0;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['za_narednu']['iznos'] = 0;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['nezaduzene']['broj'] = 0;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['nezaduzene']['iznos'] = 0;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['ukupno']['broj'] = 1;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['ukupno']['iznos'] = (float) $p->vrednost;

                if ($p->status_po_spisku == '-1') {
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['nezaduzene']['broj'] = 1;
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['nezaduzene']['iznos'] = (float) $p->vrednost;
                }

                if ($p->status_po_spisku == '0') {
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['primljene']['broj'] = 1;
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['primljene']['iznos'] = (float) $p->vrednost;
                }

                if ($p->status_po_spisku == '2') {
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['urucene']['broj'] = 1;
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['urucene']['iznos'] = (float) $p->vrednost;
                }
                
                if ($p->status_po_spisku == '1') {
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['na_dostavi']['broj'] = 1;
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['na_dostavi']['iznos'] = (float) $p->vrednost;
                }
                
                if ($p->status_po_spisku == '3') {
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['vracene']['broj'] = 1;
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['vracene']['iznos'] = (float) $p->vrednost;
                }
                
                if ($p->status_po_spisku == '4') {
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['za_narednu']['broj'] = 1;
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['za_narednu']['iznos'] = (float) $p->vrednost;
                }
            } else {
                $posiljkePoPosiljaocu[$p->posiljalac_id]['ukupno']['broj']++;
                $posiljkePoPosiljaocu[$p->posiljalac_id]['ukupno']['iznos'] += (float) $p->vrednost;

                if ($p->status_po_spisku == '-1') {
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['nezaduzene']['broj']++;
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['nezaduzene']['iznos'] += (float) $p->vrednost;
                }

                if ($p->status_po_spisku == '0') {
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['primljene']['broj']++;
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['primljene']['iznos'] += (float) $p->vrednost;
                }

                if ($p->status_po_spisku == '2') {
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['urucene']['broj']++;
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['urucene']['iznos'] += (float) $p->vrednost;
                }
                
                if ($p->status_po_spisku == '1') {
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['na_dostavi']['broj']++;
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['na_dostavi']['iznos'] += (float) $p->vrednost;
                }
                
                if ($p->status_po_spisku == '3') {
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['vracene']['broj']++;
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['vracene']['iznos'] += (float) $p->vrednost;
                }
                
                if ($p->status_po_spisku == '4') {
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['za_narednu']['broj']++;
                    $posiljkePoPosiljaocu[$p->posiljalac_id]['za_narednu']['iznos'] += (float) $p->vrednost;
                }
            }
        }

        //dd($posiljkePoPosiljaocu);
        #Izvestaj po posiljaocu kraj#
        
        return view('posiljka.index', compact('posiljke', 'nacini_placanja', 'routeFilters', 'posiljkePoPosiljaocu'));
    }

    public function indexStornirane()
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
            'firma',
            'statusi'
        ])->onlyTrashed();

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

            $izabran_bar_jedan_datum = false;
            if (request()->date_from) {
                $posiljke = $posiljke->whereRaw('date(created_at) >= ?', [Carbon::parse(request()->date_from)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (request()->date_to) {
                $posiljke = $posiljke->whereRaw('date(created_at) <= ?', [Carbon::parse(request()->date_to)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (!$izabran_bar_jedan_datum) {
                $posiljke = $posiljke->whereRaw('date(created_at) = ?', [Carbon::now()->format('Y-m-d')]);
            }

        } else {
            $izabran_bar_jedan_datum = false;
            if (request()->date_from) {
                $posiljke = $posiljke->whereRaw('date(created_at) >= ?', [Carbon::parse(request()->date_from)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (request()->date_to) {
                $posiljke = $posiljke->whereRaw('date(created_at) <= ?', [Carbon::parse(request()->date_to)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (!$izabran_bar_jedan_datum) {
                $posiljke = $posiljke->whereRaw('date(created_at) = ?', [Carbon::now()->format('Y-m-d')]);
            }
        }

        if (request()->nacin_placanja_id && request()->nacin_placanja_id != '-1') {
            $posiljke = $posiljke->where('nacin_placanja_id', request()->nacin_placanja_id);
        }

        $posiljke = $posiljke->get();

        if (request()->stampajadresnice) {
            return Posiljka::stampajAdresnice($posiljke);
        }

        if (request()->stampajspisak) {
            return Posiljka::stampajSpisak($posiljke);
        }

        $nacini_placanja = NacinPlacanja::all(['id', 'naziv']);

        $posiljke = $posiljke->map(function ($posiljka, $key) {
            $status = $posiljka->statusi->first();
            $posiljka->status_po_spisku = $status ? $status->status : '-1';
            return $posiljka;
        });

        if (request()->status_posiljke && request()->status_posiljke != '-2') {
            $posiljke = $posiljke->where('status_po_spisku', request()->status_posiljke);
        }

        $routeFilters = route('cms.posiljke-stornirane');

        $posiljkePoPosiljaocu = [];
        
        return view('posiljka.index', compact('posiljke', 'nacini_placanja', 'routeFilters', 'posiljkePoPosiljaocu'));
    }

    public function indexEksterne()
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
            'firma',
            'statusi'
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

            $izabran_bar_jedan_datum = false;
            if (request()->date_from) {
                $posiljke = $posiljke->whereRaw('date(created_at) >= ?', [Carbon::parse(request()->date_from)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (request()->date_to) {
                $posiljke = $posiljke->whereRaw('date(created_at) <= ?', [Carbon::parse(request()->date_to)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (!$izabran_bar_jedan_datum) {
                $posiljke = $posiljke->whereRaw('date(created_at) = ?', [Carbon::now()->format('Y-m-d')]);
            }

        } else {
            $izabran_bar_jedan_datum = false;
            if (request()->date_from) {
                $posiljke = $posiljke->whereRaw('date(created_at) >= ?', [Carbon::parse(request()->date_from)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (request()->date_to) {
                $posiljke = $posiljke->whereRaw('date(created_at) <= ?', [Carbon::parse(request()->date_to)->format('Y-m-d')]);
                $izabran_bar_jedan_datum = true;
            }

            if (!$izabran_bar_jedan_datum) {
                $posiljke = $posiljke->whereRaw('date(created_at) = ?', [Carbon::now()->format('Y-m-d')]);
            }
        }

        if (request()->nacin_placanja_id && request()->nacin_placanja_id != '-1') {
            $posiljke = $posiljke->where('nacin_placanja_id', request()->nacin_placanja_id);
        }

        $posiljke = $posiljke->where('interna', 0);
        $posiljke = $posiljke->get();

        if (request()->stampajadresnice) {
            return Posiljka::stampajAdresnice($posiljke);
        }

        if (request()->stampajspisak) {
            return Posiljka::stampajSpisak($posiljke);
        }

        $nacini_placanja = NacinPlacanja::all(['id', 'naziv']);

        $posiljke = $posiljke->map(function ($posiljka, $key) {
            $status = $posiljka->statusi->first();
            $posiljka->status_po_spisku = $status ? $status->status : '-1';
            return $posiljka;
        });

        if (request()->status_posiljke && request()->status_posiljke != '-2') {
            $posiljke = $posiljke->where('status_po_spisku', request()->status_posiljke);
        }

        $routeFilters = route('cms.posiljke-eksterne');

        $posiljkePoPosiljaocu = [];
        
        return view('posiljka.index', compact('posiljke', 'nacini_placanja', 'routeFilters', 'posiljkePoPosiljaocu'));
    }

    public function updateStatus($id_posiljka, $id_spisak, $status)
    {
        $dostava = Dostava::findOrFail($id_spisak);
        $posiljka = DostavaStavka::where('dostava_id', $id_spisak)->where('posiljka_id', $id_posiljka)->first();
        $posiljka->status = $status;
        $posiljka->save();

        $mozeDaSeRazduzi = DostavaStavka::mozeDaSeRazduzi($id_spisak);
        $posiljke_ids = $posiljka = DostavaStavka::where('dostava_id', $id_spisak)->pluck('posiljka_id')->toArray();

        $dostava->za_naplatu = $dostava->stavke()->where('dostava_stavka.status', 2)->sum(DB::raw('posiljka.vrednost + posiljka.postarina'));
        
        $postarinaExtra = $dostava->stavke()
            ->where('dostava_stavka.status', 3)
            ->where('posiljka.nacin_placanja_id', 3)
            ->where('dostava_stavka.vracena', 1)
            ->sum(DB::raw('posiljka.postarina * 2'));

        $dostava->za_naplatu += $postarinaExtra;
        $dostava->save();

        return response()->json(['message' => 'Uspešna izmena!', 'razduzi' => $mozeDaSeRazduzi, 'p_ids' => implode(',', $posiljke_ids), 'je_razduzen' => $dostava->status]);
    }

    public function updateStatusVracena($id_posiljka, $id_spisak, $status)
    {
        $dostava = Dostava::findOrFail($id_spisak);
        $posiljka = DostavaStavka::where('dostava_id', $id_spisak)->where('posiljka_id', $id_posiljka)->first();
        $posiljka->vracena = intval($status);
        $posiljka->save();

        $posiljke_ids = $posiljka = DostavaStavka::where('dostava_id', $id_spisak)->pluck('posiljka_id')->toArray();

        $dostava->za_naplatu = $dostava->stavke()->where('dostava_stavka.status', 2)->sum(DB::raw('posiljka.vrednost + posiljka.postarina'));
        
        $postarinaExtra = $dostava->stavke()
            ->where('dostava_stavka.status', 3)
            ->where('posiljka.nacin_placanja_id', 3)
            ->where('dostava_stavka.vracena', 1)
            ->sum(DB::raw('posiljka.postarina * 2'));

        $dostava->za_naplatu += $postarinaExtra;
        $dostava->save();

        return response()->json(['message' => 'Uspešna izmena!', 'p_ids' => implode(',', $posiljke_ids), 'je_razduzen' => $dostava->status]);
    }

    public function proveraBrojaPosiljke($broj)
    {
        return Posiljka::where('broj_posiljke', 'TE'.$broj.'BG')->first() ? '1' : '0';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            $posiljka = Posiljka::orderBy('id', 'desc')->first();
            $posiljka->broj_posiljke = null;
            $posiljka->firma_id = null;
            $posiljka->primalac_id = null;
            $posiljka->primalac = null;
            $posiljka->masa_kg = null;
            $posiljka->ima_vrednost = null;
            $posiljka->ima_otkupninu = null;
            $posiljka->vrednost = null;
            $posiljka->otkupnina = null;
            $posiljka->otkupnina_vrsta = null;
            $posiljka->broj_racuna = null;
            $posiljka->povratnica = null;
            $posiljka->licno_preuzimanje = null;
        }

        $moze_da_izmeni_broj = true;

        return view('posiljka.create', compact(
            'posiljka',
            'vrste_usluga', 
            'nacini_placanja', 
            //'posiljkaBroj',
            'moze_da_izmeni_broj'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postojiPosiljka = Posiljka::where('broj_posiljke', 'TE'.$request->broj_posiljke.'BG')->first();
        if ($postojiPosiljka) {
            return redirect()->route('cms.posiljka.create', ['prethodna'])->with('errMsg', 'Pošiljka sa zadatim brojem već postoji!');
        }

        $po_naselje = $request->po_naselje_id ? Naselje::find($request->po_naselje_id) : new Naselje;
        if (!$request->po_naselje_id) {
            $po_naselje->setValues($request->po_naselje);
            $po_naselje->save();
        }
        
        $pr_naselje = $request->pr_naselje_id ? Naselje::find($request->pr_naselje_id) : new Naselje;
        if (!$request->pr_naselje_id) {
            $pr_naselje->setValues($request->pr_naselje);
            $pr_naselje->save();
        }
        
        $po_ulica = $request->po_ulica_id ? Ulica::find($request->po_ulica_id) : new Ulica;
        if (!$request->po_ulica_id) {
            $po_ulica->setValues($request->po_ulica);
            $po_ulica->save();
        }
        
        $pr_ulica = $request->pr_ulica_id ? Ulica::find($request->pr_ulica_id) : new Ulica;
        if (!$request->pr_ulica_id) {
            $pr_ulica->setValues($request->pr_ulica);
            $pr_ulica->save();
        }

        $posiljalac = $request->posiljalac_id ? PosiljalacPrimalac::find($request->posiljalac_id) : new PosiljalacPrimalac;
        $posiljalac->posiljalacSetValues($po_naselje->id, $po_ulica->id);
        $posiljalac->save();

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

        $posiljka = new Posiljka;
        $posiljka->interna = 1;
        $posiljka->id_korisnik = Korisnik::ulogovanKorisnik()->id;
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
        
        return redirect()->route('cms.posiljka.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posiljka  $posiljka
     * @return \Illuminate\Http\Response
     */
    public function show(Posiljka $posiljka)
    {
        $barcodeImage = file_get_contents('https://barcode.tec-it.com/barcode.ashx?data='.$posiljka->broj_posiljke);
        file_put_contents($posiljka->broj_posiljke.'.jpg', $barcodeImage);

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultParagraphStyle(
            array(
                //'align'      => 'both',
                //'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(12),
                'spacing'    => 0,
                )
            );
        $section = $phpWord->addSection([
            'pageSizeH' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(6),
            'pageSizeW' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(3),
            'marginLeft' => 100, 
            'marginRight' => 100,
            'marginTop' => 0, 
            'marginBottom' => 0
        ]);

        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setName('Arial');
        $fontStyle->setSize(11);

        $description = "<w:r>
        <w:t><w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('POŠILJALAC:', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr></w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->posiljalac->naziv, 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->posiljalac->ulica." ".$posiljka->posiljalac->broj.($posiljka->posiljalac->podbroj != '' ? '('.$posiljka->posiljalac->podbroj.')' : '')."".($posiljka->posiljalac->stan != '' ? '/'.$posiljka->posiljalac->stan : ''), 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->posiljalac->naselje, 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->posiljalac->kontakt_telefon, 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->posiljalac->napomena, 'UTF-8')."</w:t>
        <w:br/>
        <w:br/>
        <w:t><w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('PRIMALAC:', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr></w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->primalac->naziv, 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->primalac->ulica." ".$posiljka->primalac->broj.($posiljka->primalac->podbroj != '' ? '('.$posiljka->primalac->podbroj.')' : '')."".($posiljka->primalac->stan != '' ? '/'.$posiljka->primalac->stan : ''), 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->primalac->naselje, 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->primalac->kontakt_telefon, 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->primalac->napomena, 'UTF-8')."</w:t>
        <w:br/>
        <w:br/>
        <w:t><w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('MASA: ', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr></w:t>
        <w:t>".mb_strtoupper($posiljka->masa_kg, 'UTF-8')." KG</w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->sadrzina, 'UTF-8')."</w:t>
        <w:br/>
        <w:t>".($posiljka->ima_otkupninu ? "<w:br/><w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('OTKUPNINA: ', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr>".$posiljka->otkupnina : '')."</w:t>
        <w:br/>
        <w:t>".((float) $posiljka->postarina > 0 ? "<w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('POŠTARINA: ', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr>".mb_strtoupper($posiljka->postarina, 'UTF-8') : '')."</w:t>
        <w:br/>
        <w:br/>
        <w:t><w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('POŠTARINU PLAĆA:', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr></w:t>
        <w:br/>
        <w:t>".mb_strtoupper($posiljka->nacinPlacanja->naziv, 'UTF-8')."</w:t>
        </w:r>";

        $footer = "<w:r>
        <w:t>".date('d.m.Y.', strtotime($posiljka->created_at))."</w:t>
        <w:br/>
        <w:t>www.topexpress.rs</w:t>
        <w:br/>
        <w:t>+381668150900</w:t>
        </w:r>";

        $section->addImage('storage/'.$posiljka->bar_kod, array('align' => 'center', 'width' => 130, 'space' => array('before' => 0, 'after' => 0)));
        // $section->addText($posiljka->broj_posiljke, null, array('align' => 'center', 'bold' => true, 'size' => 11));
        $font = $section->addText($description, null, array('marginTop' => 0, 'marginBottom' => 0, 'space' => array('before' => 0, 'after' => 0)));
        $section->addText($footer, null, array('align' => 'center', 'size' => 11, 'marginTop' => 0, 'marginBottom' => 0, 'space' => array('before' => 0, 'after' => 0)));
        $font->setFontStyle($fontStyle);

        $section->addImage('site/images/adresnica.jpg', ['align' => 'center', 'width' => 130, 'marginTop' => 0, 'marginBottom' => 0, 'space' => array('before' => 0, 'after' => 0)]);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path($posiljka->broj_posiljke.'.docx'));
        } catch (\Exception $e) {
            dd($e);
        }

        @unlink($posiljka->broj_posiljke.'.jpg');

        return response()->download(storage_path($posiljka->broj_posiljke.'.docx'))->deleteFileAfterSend(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posiljka  $posiljka
     * @return \Illuminate\Http\Response
     */
    public function edit(Posiljka $posiljka)
    {
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

        $spisak = DostavaStavka::with(['dostava'])->where('posiljka_id', $posiljka->id)->get();

        $moze_da_izmeni_broj = false;

        return view('posiljka.edit', compact(
            'posiljka',
            'vrste_usluga', 
            'nacini_placanja', 
            //'kompanije', 
            //'primalacPosiljalac', 
            //'naselja', 
            //'ulice',
            //'posiljkaBroj',
            //'racuni',
            'spisak',
            //'ugovori',
            'moze_da_izmeni_broj'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posiljka  $posiljka
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posiljka $posiljka)
    {
        $po_naselje = $request->po_naselje_id ? Naselje::find($request->po_naselje_id) : new Naselje;
        if (!$request->po_naselje_id) {
            $po_naselje->setValues($request->po_naselje);
            $po_naselje->save();
        }
        
        $pr_naselje = $request->pr_naselje_id ? Naselje::find($request->pr_naselje_id) : new Naselje;
        if (!$request->pr_naselje_id) {
            $pr_naselje->setValues($request->pr_naselje);
            $pr_naselje->save();
        }
        
        $po_ulica = $request->po_ulica_id ? Ulica::find($request->po_ulica_id) : new Ulica;
        if (!$request->po_ulica_id) {
            $po_ulica->setValues($request->po_ulica);
            $po_ulica->save();
        }
        
        $pr_ulica = $request->pr_ulica_id ? Ulica::find($request->pr_ulica_id) : new Ulica;
        if (!$request->pr_ulica_id) {
            $pr_ulica->setValues($request->pr_ulica);
            $pr_ulica->save();
        }

        $posiljalac = $request->posiljalac_id ? PosiljalacPrimalac::find($request->posiljalac_id) : new PosiljalacPrimalac;
        $posiljalac->posiljalacSetValues($po_naselje->id, $po_ulica->id);
        $posiljalac->save();

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

        //$posiljka = new Posiljka;
        $posiljka->setValues($request->firma_id ?? -1, $posiljalac->id, $primalac->id, $cena_konacna, $posiljka->broj_posiljke);
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
        
        return redirect()->route('cms.posiljka.edit', $posiljka);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posiljka  $posiljka
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posiljka $posiljka)
    {
        $stavke = DostavaStavka::where('posiljka_id', $posiljka->id)->get();

        if (count($stavke) == 0) {
            $posiljka->delete();
        }

        return redirect()->route('cms.posiljke-stornirane');
    }

    public function restore($id) 
    {
        Posiljka::where('id', $id)->withTrashed()->update([
            'deleted_at' => NULL
        ]);

        return redirect()->route('cms.posiljka.index');
    }

    public function import($id) 
    {
        Posiljka::where('id', $id)->update([
            'interna' => 1
        ]);

        return redirect()->route('cms.posiljka.index');
    }

    public function importMultiple(Request $request) 
    {
        if ($request->has('posiljke')) {
            Posiljka::whereIn('id', $request->posiljke)->update([
                'interna' => 1
            ]);
        }
        
        return redirect()->back();
    }

    public function vratiStatuse($broj_posiljke)
    {
        $posiljka = Posiljka::with([
            'posiljalac',
            'primalac',
            'vrstaUsluge',
            'nacinPlacanja',
            'firma'
        ])->where('broj_posiljke', $broj_posiljke)->first();
        
        $stavke = DostavaStavka::with([
            'posiljka',
            'posiljka.posiljalac',
            'posiljka.primalac',
            'posiljka.vrstaUsluge',
            'posiljka.nacinPlacanja',
            'posiljka.firma',
            'dostava',
        ])
        ->whereNull('dostava_stavka.deleted_at')
        ->whereHas('posiljka', function($q) use ($broj_posiljke) {
            $q->where('posiljka.broj_posiljke', $broj_posiljke);
        })->get();
        
        return response()->json(['stavke' => $stavke, 'posiljka' => $posiljka]);
    }

    public function updateBarKodovi()
    {
        $posiljke = Posiljka::all();

        DB::transaction(function () use ($posiljke) {
            foreach ($posiljke as $p) {
                $p->setBarCode();
                $p->save();
            }
        });
    }

    public function updateBarKodoviBezSlike()
    {
        $posiljke = Posiljka::all();

        DB::transaction(function () use ($posiljke) {
            foreach ($posiljke as $p) {
                $p->setBarCodeWithoutImage();
                $p->save();
            }
        });
    }
}
