<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Kompanija;
use App\Naselje;
use App\PosiljalacPrimalac;
use App\Racun;
use App\TENaselje;
use App\TEUlica;
use App\Ugovor;
use App\Ulica;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getNaselja(Request $request)
    {
        $naselja = TENaselje::where('postanski_broj', 'like', '%'.$request->get('q', '').'%')
            ->orWhere('naziv', 'like', '%'.$request->get('q', '').'%')
            ->skip(0)
            ->take($request->get('q', '') != '' ? 15 : 0)
            ->orderBy('naziv', 'asc')
            ->get();

        $result = [];

        foreach ($naselja as $naselje) {
            $result[] = (object) [
                'id' => $naselje->id,
                'text' => $naselje->postanski_broj .' '. $naselje->naziv
            ];
        }

        return response()->json($result);
    }

    public function getPravoNaselje(Request $request)
    {
        $te_naselje = TENaselje::find($request->te_naselje_id);
        $naselje = Naselje::where('naziv', 'like', '%'.$te_naselje->naziv.'%')->first();

        if ($naselje == null) {
            $naselje = new Naselje;
            $naselje->naziv = $te_naselje->naziv;
            $naselje->save();
        }

        return response()->json($naselje);
    }

    public function getUlice()
    {
        $naselja = TEUlica::all();

        $result = [];

        foreach ($naselja as $naselje) {
            $result[] = (object) [
                'id' => $naselje->id,
                'text' => $naselje->postanski_broj .' '. $naselje->naziv
            ];
        }

        return response()->json($result);
    }

    public function apiFirme(Request $request)
    {
        $data = [];

        if ($request->term == null) {
            return response()->json($data);
        }

        $items = $items = Kompanija::where('naziv', 'like', '%'.$request->term.'%')
            ->orWhere('naziv_pun', 'like', '%'.$request->term.'%')
            ->orderBy('naziv', 'asc')
            ->paginate(15);

        foreach($items as $item) {
            $data[] = (object) [
                'label' => strtoupper($item->naziv),
                'value' => $item->id,
                'obj' => $item
            ];
        }

        return response()->json($data);
    }

    public function apiUlice(Request $request)
    {
        $data = [];

        if ($request->term == null) {
            return response()->json($data);
        }

        $items = Ulica::where('naziv', 'like', '%'.$request->term.'%')
            ->groupBy('naziv')
            ->orderBy('naziv', 'asc')
            ->paginate(10);

        foreach($items as $item) {
            $data[] = (object) [
                'label' => strtoupper($item->naziv),
                'value' => $item->id,
                'obj' => $item
            ];
        }

        return response()->json($data);
    }

    public function apiNaselja(Request $request)
    {
        $data = [];

        if ($request->term == null) {
            return response()->json($data);
        }

        $items = Naselje::where('naziv', 'like', '%'.$request->term.'%')
            ->groupBy('naziv')
            ->orderBy('naziv', 'asc')
            ->paginate(10);

        foreach($items as $item) {
            $data[] = (object) [
                'label' => strtoupper($item->naziv),
                'value' => $item->id,
                'obj' => $item
            ];
        }

        return response()->json($data);
    }

    public function apiPrimalacPosiljalac(Request $request)
    {
        $data = [];

        if ($request->term == null) {
            return response()->json($data);
        }

        $items = PosiljalacPrimalac::where('naziv', 'like', '%'.$request->term.'%')
            ->groupBy('naziv')
            ->orderBy('naziv', 'asc')
            ->paginate(10);

        foreach($items as $item) {
            $data[] = (object) [
                'label' => strtoupper($item->naziv),
                'value' => $item->id,
                'obj' => $item
            ];
        }

        return response()->json($data);
    }

    public function apiRacuni(Request $request)
    {
        $data = [];

        if ($request->term == null) {
            return response()->json($data);
        }

        $items = Racun::where('broj_racuna', 'like', '%'.$request->term.'%')->orderBy('broj_racuna', 'asc')->paginate(10);

        foreach($items as $item) {
            $data[] = (object) [
                'label' => strtoupper($item->broj_racuna),
                'value' => $item->id,
                'obj' => $item
            ];
        }

        return response()->json($data);
    }

    public function apiUgovori(Request $request)
    {
        $data = [];

        if ($request->term == null) {
            return response()->json($data);
        }

        $items = Ugovor::where('broj_ugovora', 'like', '%'.$request->term.'%')->orderBy('broj_ugovora', 'asc')->paginate(10);

        foreach($items as $item) {
            $data[] = (object) [
                'label' => strtoupper($item->broj_ugovora),
                'value' => $item->id,
                'obj' => $item
            ];
        }

        return response()->json($data);
    }
}
