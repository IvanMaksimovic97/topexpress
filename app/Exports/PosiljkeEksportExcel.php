<?php

namespace App\Exports;

use App\Posiljka;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PosiljkeEksportExcel implements FromView, ShouldAutoSize
{
    public $posiljke;

    public function __construct($posiljke)
    {
        $this->posiljke = $posiljke;
    }

    public function view() : View
    {
        return view('exports.posiljke_export', ['posiljke' => $this->posiljke]);
    }
}
