<?php

namespace App\Http\Controllers;

use App\Imports\NaseljaImport;
use App\Jobs\UnosPosiljkiJob;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        UnosPosiljkiJob::dispatch();
    }
}
