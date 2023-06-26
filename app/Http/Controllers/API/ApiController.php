<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Naselje;
use App\TENaselje;
use App\TEUlica;
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
}
