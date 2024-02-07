<?php

namespace App\Http\Controllers;

use App\Imports\NaseljaImport;
use App\Jobs\UnosPosiljkiJob;
use App\Posiljka;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\TemplateProcessor;
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

    public function adresniceTemplate()
    {
        $templateProcessor = new TemplateProcessor('site/adresnice_a4_landscape.docx');

        $posiljke = Posiljka::with(['posiljalac', 'primalac', 'vlasnik', 'firma'])->where('created_at', '>=', '2024-02-04')->skip(0)->take(35)->get();
        $posiljke = array_chunk($posiljke->toArray(), 4);

        $replacements = [];

        foreach ($posiljke as $chunk) {
            $replacements[] = [
                'BarKod1' => isset($chunk[0]) ? $chunk[0]['bar_kod'] : '',
                'BrojPosiljke1' => isset($chunk[0]) ? $chunk[0]['broj_posiljke'] : '',
                'Kompanija1' => isset($chunk[0]) ? str_replace('&', '', $chunk[0]['firma'] ? $chunk[0]['firma']['naziv_pun'] : $chunk[0]['posiljalac']['naziv']) : '',
                'AdresaKompanije1' => isset($chunk[0]) ? str_replace('&', '', $chunk[0]['firma'] ? $chunk[0]['firma']['adresa'] : $chunk[0]['posiljalac']['naselje'].', '.$chunk[0]['posiljalac']['ulica'].' '.$chunk[0]['posiljalac']['broj']) : '',
                'TelefonKompanije1' => isset($chunk[0]) ? str_replace('&', '', $chunk[0]['firma'] ? $chunk[0]['firma']['telefon'] : $chunk[0]['posiljalac']['kontakt_telefon']) : '',
                'ImePrezime1' => isset($chunk[0]) ? str_replace('&', '', $chunk[0]['primalac']['naziv']) : '',
                'Adresa1' => isset($chunk[0]) ? str_replace('&', '', $chunk[0]['primalac']['ulica'].' '.$chunk[0]['primalac']['broj']) : '',
                'Naselje1' => isset($chunk[0]) ? str_replace('&', '', $chunk[0]['primalac']['naselje']) : '',
                'Telefon1' => isset($chunk[0]) ? str_replace('&', '', $chunk[0]['primalac']['kontakt_telefon']) : '',
                'Masa1' => isset($chunk[0]) ? 'MASA: '.$chunk[0]['masa_kg'].' KG' : '',
                'Sadrzaj1' => isset($chunk[0]) ? 'SADRŽAJ: '.str_replace('&', '', $chunk[0]['sadrzina']) : '',
                'Otkupnina1' => isset($chunk[0]) ? 'OTKUPNINA: '.$chunk[0]['otkupnina'] : '',
                'DatumKreiranja1' => isset($chunk[0]) ? date('d.m.Y', strtotime($chunk[0]['created_at'])) : '',
                'SajtURL1' => isset($chunk[0]) ? 'www.topexpress.rs' : '',
                'TETelefon1' => isset($chunk[0]) ? '+381668150900' : '',

                'BarKod2' => isset($chunk[1]) ? $chunk[1]['bar_kod'] : '',
                'BrojPosiljke2' => isset($chunk[1]) ? $chunk[1]['broj_posiljke'] : '',
                'Kompanija2' => isset($chunk[1]) ? str_replace('&', '', $chunk[1]['firma'] ? $chunk[1]['firma']['naziv_pun'] : $chunk[1]['posiljalac']['naziv']) : '',
                'AdresaKompanije2' => isset($chunk[1]) ? str_replace('&', '', $chunk[1]['firma'] ? $chunk[1]['firma']['adresa'] : $chunk[1]['posiljalac']['naselje'].', '.$chunk[1]['posiljalac']['ulica'].' '.$chunk[1]['posiljalac']['broj']) : '',
                'TelefonKompanije2' => isset($chunk[1]) ? str_replace('&', '', $chunk[1]['firma'] ? $chunk[1]['firma']['telefon'] : $chunk[1]['posiljalac']['kontakt_telefon']) : '',
                'ImePrezime2' => isset($chunk[1]) ? str_replace('&', '', $chunk[1]['primalac']['naziv']) : '',
                'Adresa2' => isset($chunk[1]) ? str_replace('&', '', $chunk[1]['primalac']['ulica'].' '.$chunk[1]['primalac']['broj']) : '',
                'Naselje2' => isset($chunk[1]) ? str_replace('&', '', $chunk[1]['primalac']['naselje']) : '',
                'Telefon2' => isset($chunk[1]) ? str_replace('&', '', $chunk[1]['primalac']['kontakt_telefon']) : '',
                'Masa2' => isset($chunk[1]) ? 'MASA: '.$chunk[1]['masa_kg'].' KG' : '',
                'Sadrzaj2' => isset($chunk[1]) ? 'SADRŽAJ: '.str_replace('&', '', $chunk[1]['sadrzina']) : '',
                'Otkupnina2' => isset($chunk[1]) ? 'OTKUPNINA: '.$chunk[1]['otkupnina'] : '',
                'DatumKreiranja2' => isset($chunk[1]) ? date('d.m.Y', strtotime($chunk[1]['created_at'])) : '',
                'SajtURL2' => isset($chunk[1]) ? 'www.topexpress.rs' : '',
                'TETelefon2' => isset($chunk[1]) ? '+381668150900' : '',

                'BarKod3' => isset($chunk[2]) ? $chunk[2]['bar_kod'] : '',
                'BrojPosiljke3' => isset($chunk[2]) ? $chunk[2]['broj_posiljke'] : '',
                'Kompanija3' => isset($chunk[2]) ? str_replace('&', '', $chunk[2]['firma'] ? $chunk[2]['firma']['naziv_pun'] : $chunk[2]['posiljalac']['naziv']) : '',
                'AdresaKompanije3' => isset($chunk[2]) ? str_replace('&', '', $chunk[2]['firma'] ? $chunk[2]['firma']['adresa'] : $chunk[2]['posiljalac']['naselje'].', '.$chunk[2]['posiljalac']['ulica'].' '.$chunk[2]['posiljalac']['broj']) : '',
                'TelefonKompanije3' => isset($chunk[2]) ? str_replace('&', '', $chunk[2]['firma'] ? $chunk[2]['firma']['telefon'] : $chunk[2]['posiljalac']['kontakt_telefon']) : '',
                'ImePrezime3' => isset($chunk[2]) ? str_replace('&', '', $chunk[2]['primalac']['naziv']) : '',
                'Adresa3' => isset($chunk[2]) ? str_replace('&', '', $chunk[2]['primalac']['ulica'].' '.$chunk[2]['primalac']['broj']) : '',
                'Naselje3' => isset($chunk[2]) ? str_replace('&', '', $chunk[2]['primalac']['naselje']) : '',
                'Telefon3' => isset($chunk[2]) ? str_replace('&', '', $chunk[2]['primalac']['kontakt_telefon']) : '',
                'Masa3' => isset($chunk[2]) ? 'MASA: '.$chunk[2]['masa_kg'].' KG' : '',
                'Sadrzaj3' => isset($chunk[2]) ? 'SADRŽAJ: '.str_replace('&', '', $chunk[2]['sadrzina']) : '',
                'Otkupnina3' => isset($chunk[2]) ? 'OTKUPNINA: '.$chunk[2]['otkupnina'] : '',
                'DatumKreiranja3' => isset($chunk[2]) ? date('d.m.Y', strtotime($chunk[2]['created_at'])) : '',
                'SajtURL3' => isset($chunk[2]) ? 'www.topexpress.rs' : '',
                'TETelefon3' => isset($chunk[2]) ? '+381668150900' : '',

                'BarKod4' => isset($chunk[3]) ? $chunk[3]['bar_kod'] : '',
                'BrojPosiljke4' => isset($chunk[3]) ? $chunk[3]['broj_posiljke'] : '',
                'Kompanija4' => isset($chunk[3]) ? str_replace('&', '', $chunk[3]['firma'] ? $chunk[3]['firma']['naziv_pun'] : $chunk[3]['posiljalac']['naziv']) : '',
                'AdresaKompanije4' => isset($chunk[3]) ? str_replace('&', '', $chunk[3]['firma'] ? $chunk[3]['firma']['adresa'] : $chunk[3]['posiljalac']['naselje'].', '.$chunk[3]['posiljalac']['ulica'].' '.$chunk[3]['posiljalac']['broj']) : '',
                'TelefonKompanije4' => isset($chunk[3]) ? str_replace('&', '', $chunk[3]['firma'] ? $chunk[3]['firma']['telefon'] : $chunk[3]['posiljalac']['kontakt_telefon']) : '',
                'ImePrezime4' => isset($chunk[3]) ? str_replace('&', '', $chunk[3]['primalac']['naziv']) : '',
                'Adresa4' => isset($chunk[3]) ? str_replace('&', '', $chunk[3]['primalac']['ulica'].' '.$chunk[3]['primalac']['broj']) : '',
                'Naselje4' => isset($chunk[3]) ? str_replace('&', '', $chunk[3]['primalac']['naselje']) : '',
                'Telefon4' => isset($chunk[3]) ? str_replace('&', '', $chunk[3]['primalac']['kontakt_telefon']) : '',
                'Masa4' => isset($chunk[3]) ? 'MASA: '.$chunk[3]['masa_kg'].' KG' : '',
                'Sadrzaj4' => isset($chunk[3]) ? 'SADRŽAJ: '.str_replace('&', '', $chunk[3]['sadrzina']) : '',
                'Otkupnina4' => isset($chunk[3]) ? 'OTKUPNINA: '.$chunk[3]['otkupnina'] : '',
                'DatumKreiranja4' => isset($chunk[3]) ? date('d.m.Y', strtotime($chunk[3]['created_at'])) : '',
                'SajtURL4' => isset($chunk[3]) ? 'www.topexpress.rs' : '',
                'TETelefon4' => isset($chunk[3]) ? '+381668150900' : '',
            ];
        }

        $templateProcessor->cloneBlock('block', count($posiljke), true, true);

        foreach ($replacements as $key => $item) {
            foreach ($item as $name => $value) {
                if ($name != 'BarKod1' && $name != 'BarKod2' && $name != 'BarKod3' && $name != 'BarKod4' && $name != 'BarKod4') {
                    $templateProcessor->setValue($name.'#'.($key + 1), $value);
                }   
            }

            if ($item['BarKod1'] != '') {
                $templateProcessor->setValue('POSILJALAC1#'.($key + 1), 'POŠILJALAC:');
                $templateProcessor->setValue('PRIMALAC1#'.($key + 1), 'PRIMALAC:');
                $templateProcessor->setValue('POSTARINUPLACA1#'.($key + 1), 'POSTARINU PLAĆA:');
                $templateProcessor->setValue('VrstaPlacanja1#'.($key + 1), 'POŠILJALAC GOTOVINSKI');
                $templateProcessor->setImageValue('TELOGO1#'.($key + 1), array('path' => 'site/images/adresnica.jpg', 'width' => 175, 'height' => 43, 'ratio' => false));
                $templateProcessor->setImageValue('BarKod1#'.($key + 1), array('path' => env('BARCODE_STORAGE_PATH').$item['BarKod1'], 'width' => 190, 'height' => 55, 'ratio' => false));
            } else {
                $templateProcessor->setValue('POSILJALAC1#'.($key + 1), '');
                $templateProcessor->setValue('PRIMALAC1#'.($key + 1), '');
                $templateProcessor->setValue('POSTARINUPLACA1#'.($key + 1), '');
                $templateProcessor->setValue('VrstaPlacanja1#'.($key + 1), '');
                $templateProcessor->setValue('TELOGO1#'.($key + 1), '');
                $templateProcessor->setValue('BarKod1#'.($key + 1), '');
            }

            if ($item['BarKod2'] != '') {
                $templateProcessor->setValue('POSILJALAC2#'.($key + 1), 'POŠILJALAC:');
                $templateProcessor->setValue('PRIMALAC2#'.($key + 1), 'PRIMALAC:');
                $templateProcessor->setValue('POSTARINUPLACA2#'.($key + 1), 'POSTARINU PLAĆA:');
                $templateProcessor->setValue('VrstaPlacanja2#'.($key + 1), 'POŠILJALAC GOTOVINSKI');
                $templateProcessor->setImageValue('TELOGO2#'.($key + 1), array('path' => 'site/images/adresnica.jpg', 'width' => 175, 'height' => 43, 'ratio' => false));
                $templateProcessor->setImageValue('BarKod2#'.($key + 1), array('path' => env('BARCODE_STORAGE_PATH').$item['BarKod2'], 'width' => 190, 'height' => 55, 'ratio' => false));
            } else {
                $templateProcessor->setValue('POSILJALAC2#'.($key + 1), '');
                $templateProcessor->setValue('PRIMALAC2#'.($key + 1), '');
                $templateProcessor->setValue('POSTARINUPLACA2#'.($key + 1), '');
                $templateProcessor->setValue('VrstaPlacanja2#'.($key + 1), '');
                $templateProcessor->setValue('TELOGO2#'.($key + 1), '');
                $templateProcessor->setValue('BarKod2#'.($key + 1), '');
            }

            if ($item['BarKod3'] != '') {
                $templateProcessor->setValue('POSILJALAC3#'.($key + 1), 'POŠILJALAC:');
                $templateProcessor->setValue('PRIMALAC3#'.($key + 1), 'PRIMALAC:');
                $templateProcessor->setValue('POSTARINUPLACA3#'.($key + 1), 'POSTARINU PLAĆA:');
                $templateProcessor->setValue('VrstaPlacanja3#'.($key + 1), 'POŠILJALAC GOTOVINSKI');
                $templateProcessor->setImageValue('TELOGO3#'.($key + 1), array('path' => 'site/images/adresnica.jpg', 'width' => 175, 'height' => 43, 'ratio' => false));
                $templateProcessor->setImageValue('BarKod3#'.($key + 1), array('path' => env('BARCODE_STORAGE_PATH').$item['BarKod3'], 'width' => 190, 'height' => 55, 'ratio' => false));
            } else {
                $templateProcessor->setValue('POSILJALAC3#'.($key + 1), '');
                $templateProcessor->setValue('PRIMALAC3#'.($key + 1), '');
                $templateProcessor->setValue('POSTARINUPLACA3#'.($key + 1), '');
                $templateProcessor->setValue('VrstaPlacanja3#'.($key + 1), '');
                $templateProcessor->setValue('TELOGO3#'.($key + 1), '');
                $templateProcessor->setValue('BarKod3#'.($key + 1), '');
            }

            if ($item['BarKod4'] != '') {
                $templateProcessor->setValue('POSILJALAC4#'.($key + 1), 'POŠILJALAC:');
                $templateProcessor->setValue('PRIMALAC4#'.($key + 1), 'PRIMALAC:');
                $templateProcessor->setValue('POSTARINUPLACA4#'.($key + 1), 'POSTARINU PLAĆA:');
                $templateProcessor->setValue('VrstaPlacanja4#'.($key + 1), 'POŠILJALAC GOTOVINSKI');
                $templateProcessor->setImageValue('TELOGO4#'.($key + 1), array('path' => 'site/images/adresnica.jpg', 'width' => 175, 'height' => 43, 'ratio' => false));
                $templateProcessor->setImageValue('BarKod4#'.($key + 1), array('path' => env('BARCODE_STORAGE_PATH').$item['BarKod4'], 'width' => 190, 'height' => 55, 'ratio' => false));
            } else {
                $templateProcessor->setValue('POSILJALAC4#'.($key + 1), '');
                $templateProcessor->setValue('PRIMALAC4#'.($key + 1), '');
                $templateProcessor->setValue('POSTARINUPLACA4#'.($key + 1), '');
                $templateProcessor->setValue('VrstaPlacanja4#'.($key + 1), '');
                $templateProcessor->setValue('TELOGO4#'.($key + 1), '');
                $templateProcessor->setValue('BarKod4#'.($key + 1), '');
            }
        }

        $templateProcessor->saveAs('site/TemplateProcessed.docx');

        $filePath = 'site/TemplateProcessed.docx';

        // Check if the file exists
        if (file_exists($filePath)) {
            
            // Set headers to force the browser to download the file
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filePath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));

            // Read the file and output it to the browser
            readfile($filePath);
            
            exit;
        } else {
            // If the file does not exist, you can handle the error accordingly
            echo "File not found!";
        }

    }
}
