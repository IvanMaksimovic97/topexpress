<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpOffice\PhpWord\TemplateProcessor;
use Picqer\Barcode\BarcodeGeneratorPNG;

class Posiljka extends Model
{
    use SoftDeletes;

    protected $table = 'posiljka';
    protected $guarded = [];

    public static $stampaj_kao_firma = false;

    public function posiljalac()
    {
        return $this->hasOne(PosiljalacPrimalac::class, 'id', 'posiljalac_id');
    }

    public function primalac()
    {
        return $this->hasOne(PosiljalacPrimalac::class, 'id', 'primalac_id');
    }

    public function vrstaUsluge()
    {
        return $this->hasOne(VrstaUsluge::class, 'id', 'vrsta_usluge_id');
    }

    public function nacinPlacanja()
    {
        return $this->hasOne(NacinPlacanja::class, 'id', 'nacin_placanja_id');
    }

    public function firma()
    {
        return $this->hasOne(Kompanija::class, 'id', 'firma_id');
    }

    public function vlasnik()
    {
        return $this->hasOne(Korisnik::class, 'id', 'id_korisnik');
    }

    public function dostave()
    {
        return $this->belongsToMany(Dostava::class, 'dostava_stavka');
    }

    public function statusi()
    {
        return $this->hasMany(DostavaStavka::class, 'posiljka_id', 'id')->orderBy('id', 'desc');
    }

    public function setValues($firma_id, $posiljalac_id, $primalac_id, $postarina, $broj_p = null)
    {
        //$this->id_korisnik = request()->route()->getName() == 'posiljke-nova-store-site' ? Korisnik::ulogovanKorisnikSite()->id : Korisnik::ulogovanKorisnik()->id;
        $this->vrsta_usluge_id = request()->vrsta_usluge_id;
        $this->nacin_placanja_id = request()->nacin_placanja_id;
        $this->firma_id = $firma_id;
        $this->posiljalac_id = $posiljalac_id;
        $this->primalac_id = $primalac_id;
        
        // if ($broj_p) {
        //     $this->broj_posiljke = $broj_p;
        // } else {
        //     $this->broj_posiljke = 'TE'.(request()->broj_posiljke ?? '').'BG';
        // }
        
        $this->broj_dolaznice = request()->broj_dolaznice ?? '';
        $this->broj_racuna = request()->broj_racuna ?? '';
        $this->ugovor = request()->ugovor ?? '';
        $this->sadrzina = request()->sadrzina ?? '';
        $this->masa_kg = floatval(request()->masa_kg);
        $this->ima_vrednost = request()->has('ima_vrednost') ? 1 : 0;
        $this->vrednost = request()->vrednost ?? 0;
        $this->ima_otkupninu = request()->has('ima_otkupninu') ? 1 : 0;
        $this->otkupnina = request()->otkupnina ?? 0;
        $this->povratnica = request()->has('povratnica') ? 1 : 0;
        $this->licno_preuzimanje = request()->has('licno_urucenje') ? 1 : 0;
        $this->otkupnina_vrsta = request()->has('otkupnina_vrsta') ? request()->otkupnina_vrsta : '';
        $this->postarina = $postarina;

        if ($this->nacin_placanja_id == '1' || $this->nacin_placanja_id == '2') {
            $this->postarina = 0;
        }
        
        $this->created_at = date('Y-m-d H:i:s', strtotime(request()->created_at ?? date('Y-m-d H:i:s')));
        //$this->status = 0;
    }

    public function setBarCode()
    {
        @unlink($this->bar_kod);

        $barcodeImage = file_get_contents('https://barcode.tec-it.com/barcode.ashx?data='.$this->broj_posiljke);
        file_put_contents(env('BARCODE_STORAGE_PATH').$this->broj_posiljke.'.jpg', $barcodeImage);

        $this->bar_kod = $this->broj_posiljke.'.jpg';
    }

    public function setBarCodeSDK()
    {
        @unlink($this->bar_kod);

        $generator = new BarcodeGeneratorPNG;
        file_put_contents(env('BARCODE_STORAGE_PATH').$this->broj_posiljke.'.png', $generator->getBarcode($this->broj_posiljke, $generator::TYPE_CODE_128, 2, 90));

        $this->bar_kod = $this->broj_posiljke.'.png';
    }

    public function setBarCodeWithoutImage()
    {
        $this->bar_kod = $this->broj_posiljke.'.jpg';
    }

    public static function stampajAdresnice(Collection $posiljke) 
    {
        //\PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

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

        foreach ($posiljke as $key => $posiljka) {
            $posiljalac_naziv = $posiljka->posiljalac->naziv;
            $posiljalac_adresa = $posiljka->posiljalac->ulica." ".$posiljka->posiljalac->broj.($posiljka->posiljalac->podbroj != '' ? '('.$posiljka->posiljalac->podbroj.')' : '')."".($posiljka->posiljalac->stan != '' ? '/'.$posiljka->posiljalac->stan : '');
            $posiljalac_naselje = $posiljka->posiljalac->naselje;
            $posiljalac_telefon = $posiljka->posiljalac->kontakt_telefon;

            if (self::$stampaj_kao_firma && Korisnik::ulogovanKorisnikSite()->kompanija) {
                $kompanija = Korisnik::ulogovanKorisnikSite()->kompanija;
                $posiljalac_naziv = $kompanija->naziv_pun;
                $posiljalac_adresa = $kompanija->adresa;
                $posiljalac_telefon = $kompanija->telefon;
                $posiljalac_naselje = '';
            }

            $posiljalac_naziv = str_replace('&', '', $posiljalac_naziv);
            $posiljalac_adresa = str_replace('&', '', $posiljalac_adresa);
            $posiljalac_naselje = str_replace('&', '', $posiljalac_naselje);
            $posiljalac_telefon = str_replace('&', '', $posiljalac_telefon);

            $description = "<w:r>
            <w:t><w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('POŠILJALAC:', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr></w:t>
            <w:br/>
            <w:t>".mb_strtoupper($posiljalac_naziv, 'UTF-8')."</w:t>
            <w:br/>
            <w:t>".mb_strtoupper($posiljalac_adresa, 'UTF-8')."</w:t>
            <w:br/>
            <w:t>".mb_strtoupper($posiljalac_naselje, 'UTF-8')."</w:t>
            <w:br/>
            <w:t>".mb_strtoupper($posiljalac_telefon, 'UTF-8')."</w:t>
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
            <w:t><w:rPr><w:b w:val='true'/></w:rPr>".mb_strtoupper('POŠTARINU PLAĆA:', 'UTF-8')."<w:rPr><w:b w:val='false'/></w:rPr></w:t>
            <w:br/>
            <w:t>".mb_strtoupper($posiljka->nacinPlacanja->naziv, 'UTF-8')."</w:t>
            </w:r>";
    
            // $footer = "<w:r>
            // <w:t>TOPEXPRESS 2022 DOO</w:t>
            // <w:br/>
            // <w:t>WWW.TOPEXPRESS.RS</w:t>
            // <w:br/>
            // <w:t>+381 11 77777 33</w:t>
            // <w:br/>
            // <w:t>+381 66 815 0 900</w:t>
            // </w:r>";
    
            $footer = "<w:r>
            <w:t>".date('d.m.Y.', strtotime($posiljka->created_at))."</w:t>
            <w:br/>
            <w:t>".$posiljka->broj_posiljke."</w:t>
            <w:br/>
            <w:t>Tel:+381668150900</w:t>
            </w:r>";
    
            $section->addImage('storage/'.$posiljka->bar_kod, array('align' => 'center', 'width' => 130, 'space' => array('before' => 0, 'after' => 0)));
            // $section->addText($posiljka->broj_posiljke, null, array('align' => 'center', 'bold' => true, 'size' => 11));
            $font = $section->addText($description, null, array('marginTop' => 0, 'marginBottom' => 0, 'space' => array('before' => 0, 'after' => 0)));
            $section->addText($footer, null, array('align' => 'center', 'size' => 9, 'marginTop' => 0, 'marginBottom' => 0, 'space' => array('before' => 0, 'after' => 0)));
            $font->setFontStyle($fontStyle);
    
            $section->addImage('site/images/adresnica.jpg', ['align' => 'center', 'width' => 130, 'marginTop' => 0, 'marginBottom' => 0, 'space' => array('before' => 0, 'after' => 0)]);
    
            if ($key != ($posiljke->count() -1 )) {
                $section->addPageBreak();
            }
        }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('adresnice.docx'));
        } catch (\Exception $e) {
            dd($e);
        }

        return response()->download(storage_path('adresnice.docx'))->deleteFileAfterSend(true);
    }

    public static function stampajSpisak(Collection $posiljke, $posiljalac = null)
    {
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

        $posiljke->push($sum_posiljka);

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultParagraphStyle(array('align' => 'both', 'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0), 'spacing' => 0));
        $section = $phpWord->addSection(array('orientation' => 'landscape'));
        
        $header = array('size' => 16, 'bold' => true);

        $dateFrom = request()->date_from ?? now();
        $dateTo = request()->date_to ?? now();

        if (request()->has('date')) {
            $dateFrom = request()->date;
            $dateTo = request()->date;
        }

        $section->addText(htmlspecialchars('Datum od: '.date('d.m.Y.', strtotime($dateFrom)).' - Datum do: '.date('d.m.Y.', strtotime($dateTo))), $header);
        $section->addTextBreak(1);

        if ($posiljalac) {
            $posiljalac_str = 'Pošiljalac: ' . $posiljalac->ime . ' ' . $posiljalac->prezime;
            if ($posiljalac->kompanija) {
                $posiljalac_str = 'Pošiljalac: ' . $posiljalac->kompanija->naziv_pun;
            }
            $section->addText(htmlspecialchars($posiljalac_str), $header);
            $section->addTextBreak(1);
    
            // $section->addText(htmlspecialchars('adresa i broj telefona :'), $header);
            // $section->addTextBreak(1);
        }
        
        $styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80);
        $styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '000000');
        $styleCell = array('space' => array('line' => 1000));
        $fontStyle = array('bold' => true, 'align' => 'center');
        $phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
        $table = $section->addTable('Fancy Table');

        $table->addRow();
        $table->addCell(500, $styleCell)->addText(htmlspecialchars('R.B.'), $fontStyle);
        $table->addCell(1500, $styleCell)->addText(htmlspecialchars('BROJ POŠILJKE'), $fontStyle);
        $table->addCell(3000, $styleCell)->addText(htmlspecialchars('PRIMALAC'), $fontStyle);
        $table->addCell(3500, $styleCell)->addText(htmlspecialchars('MESTO PRIMAOCA'), $fontStyle);
        $table->addCell(3500, $styleCell)->addText(htmlspecialchars('ADRESA PRIMAOCA'), $fontStyle);
        $table->addCell(1500, $styleCell)->addText(htmlspecialchars('BROJ TEL. PRIMAOCA'), $fontStyle);
        $table->addCell(1000, $styleCell)->addText(htmlspecialchars('MASA (kg)'), $fontStyle);
        $table->addCell(1000, $styleCell)->addText(htmlspecialchars('OTKUPNINA'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('OPIS SADRŽINE'), $fontStyle);

        $rb = 1;
        foreach ($posiljke as $stavka) {
            $table->addRow();

            $c1 = $table->addCell(1500);
            $c1->addText(htmlspecialchars($rb));
            
            $c2 = $table->addCell(1500);
            $c2->addText(htmlspecialchars($stavka->broj_posiljke));

            $c3 = $table->addCell(3000);
            $c3->addText(htmlspecialchars(strtoupper($stavka->primalac->naziv)));

            $c4 = $table->addCell(3500);
            $c4->addText(htmlspecialchars(strtoupper(trim($stavka->primalac->naselje))));

            $adresa = trim($stavka->primalac->ulica).' '.trim($stavka->primalac->broj).''.($stavka->primalac->podbroj != '' ? '('.$stavka->primalac->podbroj.')' : '');
            if ($stavka->primalac->stan != '') {
                $adresa .= '/'.$stavka->primalac->stan;
            }

            $c5 = $table->addCell(3500);
            $c5->addText(htmlspecialchars(strtoupper(trim($adresa))));

            if ($stavka->primalac->sprat) {
                $c5->addText(htmlspecialchars('Sprat: '.$stavka->primalac->sprat));
            }

            $c6 = $table->addCell(1500);
            $c6->addText(htmlspecialchars($stavka->primalac->kontakt_telefon));

            $c7 = $table->addCell(1000);
            $c7->addText(htmlspecialchars($stavka->masa_kg));

            $c7 = $table->addCell(1000);
            $c7->addText(htmlspecialchars(number_format($stavka->otkupnina, 2,',', '.')));

            $c8 = $table->addCell(2000)->addText(htmlspecialchars($stavka->sadrzina));

            $rb++;
        }
        
        // $section->addTextBreak(1);
        // $section->addText(htmlspecialchars('POŠILJKE PREDAO: '.Korisnik::ulogovanKorisnik()->ime.' '.Korisnik::ulogovanKorisnik()->prezime));
        // $section->addTextBreak(1);
        // $section->addText(htmlspecialchars('POŠILJKE PRIMIO: '.$dostava->radnik));

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path(time().'.docx'));
        } catch (\Exception $e) {
            dd($e);
        }

        return response()->download(storage_path(time().'.docx'))->deleteFileAfterSend(true);
    }

    public static function stampajAdresniceA4($posiljke, $template)
    {
        $templateProcessor = new TemplateProcessor($template);

        $posiljke = array_chunk($posiljke->toArray(), 4);
        $replacements = [];

        foreach ($posiljke as $chunk) {
            //dd($chunk);
            $replacements[] = [
                'BarKod1' => isset($chunk[0]) ? $chunk[0]['bar_kod'] : '',
                'BrojPosiljke1' => isset($chunk[0]) ? $chunk[0]['broj_posiljke'] : '',
                'Kompanija1' => isset($chunk[0]) ? str_replace('&', '', $chunk[0]['firma'] ? $chunk[0]['firma']['naziv_pun'] : $chunk[0]['posiljalac']['naziv']) : '',
                'AdresaKompanije1' => isset($chunk[0]) ? str_replace('&', '', $chunk[0]['firma'] ? $chunk[0]['firma']['adresa'] : $chunk[0]['posiljalac']['naselje']['naziv'].', '.$chunk[0]['posiljalac']['ulica']['naziv'].' '.$chunk[0]['posiljalac']['broj']) : '',
                'TelefonKompanije1' => isset($chunk[0]) ? str_replace('&', '', $chunk[0]['firma'] ? $chunk[0]['firma']['telefon'] : $chunk[0]['posiljalac']['kontakt_telefon']) : '',
                'ImePrezime1' => isset($chunk[0]) ? str_replace('&', '', $chunk[0]['primalac']['naziv']) : '',
                'Adresa1' => isset($chunk[0]) ? str_replace('&', '', $chunk[0]['primalac']['ulica']['naziv'].' '.$chunk[0]['primalac']['broj']) : '',
                'Naselje1' => isset($chunk[0]) ? str_replace('&', '', $chunk[0]['primalac']['naselje']['naziv']) : '',
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
                'AdresaKompanije2' => isset($chunk[1]) ? str_replace('&', '', $chunk[1]['firma'] ? $chunk[1]['firma']['adresa'] : $chunk[1]['posiljalac']['naselje']['naziv'].', '.$chunk[1]['posiljalac']['ulica']['naziv'].' '.$chunk[1]['posiljalac']['broj']) : '',
                'TelefonKompanije2' => isset($chunk[1]) ? str_replace('&', '', $chunk[1]['firma'] ? $chunk[1]['firma']['telefon'] : $chunk[1]['posiljalac']['kontakt_telefon']) : '',
                'ImePrezime2' => isset($chunk[1]) ? str_replace('&', '', $chunk[1]['primalac']['naziv']) : '',
                'Adresa2' => isset($chunk[1]) ? str_replace('&', '', $chunk[1]['primalac']['ulica']['naziv'].' '.$chunk[1]['primalac']['broj']) : '',
                'Naselje2' => isset($chunk[1]) ? str_replace('&', '', $chunk[1]['primalac']['naselje']['naziv']) : '',
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
                'AdresaKompanije3' => isset($chunk[2]) ? str_replace('&', '', $chunk[2]['firma'] ? $chunk[2]['firma']['adresa'] : $chunk[2]['posiljalac']['naselje']['naziv'].', '.$chunk[2]['posiljalac']['ulica']['naziv'].' '.$chunk[2]['posiljalac']['broj']) : '',
                'TelefonKompanije3' => isset($chunk[2]) ? str_replace('&', '', $chunk[2]['firma'] ? $chunk[2]['firma']['telefon'] : $chunk[2]['posiljalac']['kontakt_telefon']) : '',
                'ImePrezime3' => isset($chunk[2]) ? str_replace('&', '', $chunk[2]['primalac']['naziv']) : '',
                'Adresa3' => isset($chunk[2]) ? str_replace('&', '', $chunk[2]['primalac']['ulica']['naziv'].' '.$chunk[2]['primalac']['broj']) : '',
                'Naselje3' => isset($chunk[2]) ? str_replace('&', '', $chunk[2]['primalac']['naselje']['naziv']) : '',
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
                'AdresaKompanije4' => isset($chunk[3]) ? str_replace('&', '', $chunk[3]['firma'] ? $chunk[3]['firma']['adresa'] : $chunk[3]['posiljalac']['naselje']['naziv'].', '.$chunk[3]['posiljalac']['ulica']['naziv'].' '.$chunk[3]['posiljalac']['broj']) : '',
                'TelefonKompanije4' => isset($chunk[3]) ? str_replace('&', '', $chunk[3]['firma'] ? $chunk[3]['firma']['telefon'] : $chunk[3]['posiljalac']['kontakt_telefon']) : '',
                'ImePrezime4' => isset($chunk[3]) ? str_replace('&', '', $chunk[3]['primalac']['naziv']) : '',
                'Adresa4' => isset($chunk[3]) ? str_replace('&', '', $chunk[3]['primalac']['ulica']['naziv'].' '.$chunk[3]['primalac']['broj']) : '',
                'Naselje4' => isset($chunk[3]) ? str_replace('&', '', $chunk[3]['primalac']['naselje']['naziv']) : '',
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
            return "File not found!";
        }
    }
}
