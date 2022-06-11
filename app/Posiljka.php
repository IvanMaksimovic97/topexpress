<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posiljka extends Model
{
    use SoftDeletes;

    protected $table = 'posiljka';
    protected $guarded = [];

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

    public function dostave()
    {
        return $this->belongsToMany(Dostava::class, 'dostava_stavka');
    }

    public function setValues($firma_id, $posiljalac_id, $primalac_id, $postarina)
    {
        $this->vrsta_usluge_id = request()->vrsta_usluge_id;
        $this->nacin_placanja_id = request()->nacin_placanja_id;
        $this->firma_id = $firma_id;
        $this->posiljalac_id = $posiljalac_id;
        $this->primalac_id = $primalac_id;
        $this->broj_posiljke = request()->broj_posiljke ?? '';
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
        $this->postarina = $this->nacin_placanja_id == '1' ? 0 : $postarina;
        //$this->status = 0;
    }

    public function setBarCode()
    {
        @unlink($this->bar_kod);

        $barcodeImage = file_get_contents('https://barcode.tec-it.com/barcode.ashx?data='.$this->broj_posiljke);
        file_put_contents('storage/'.$this->broj_posiljke.'.jpg', $barcodeImage);

        $this->bar_kod = $this->broj_posiljke.'.jpg';
    }

    public function setBarCodeWithoutImage()
    {
        $this->bar_kod = $this->broj_posiljke.'.jpg';
    }

    public static function stampajAdresnice(Collection $posiljke) 
    {
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
            <w:t>".date('d.m.Y.')."</w:t>
            </w:r>";
    
            $section->addImage('storage/'.$posiljka->bar_kod, array('align' => 'center', 'width' => 130));
            // $section->addText($posiljka->broj_posiljke, null, array('align' => 'center', 'bold' => true, 'size' => 11));
            $font = $section->addText($description);
            $section->addText($footer, null, array('align' => 'center', 'size' => 11));
            $font->setFontStyle($fontStyle);
    
            $section->addImage('site/images/adresnica.jpg', ['align' => 'center', 'width' => 130]);
    
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
}
