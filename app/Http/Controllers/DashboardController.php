<?php

namespace App\Http\Controllers;

use App\Imports\NaseljaImport;
use App\Jobs\UnosPosiljkiJob;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Picqer\Barcode\BarcodeGeneratorPNG;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');
    }

    public function uploadExcel(Request $request)
    {
        $import = new NaseljaImport;
        Excel::import($import, $request->file('excel'));
    }

    public function queue()
    {
        $generator = new BarcodeGeneratorPNG;
        file_put_contents(env('BARCODE_STORAGE_PATH').'barcode.png', $generator->getBarcode('TE000000BG', $generator::TYPE_CODE_128, 2, 80));
    }
}
