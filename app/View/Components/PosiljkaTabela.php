<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PosiljkaTabela extends Component
{
    public $posiljke;
    public $dostava;
    public $posiljaociIzvestaj = [];
    public $posiljkePoPosiljaocu = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posiljke, $dostava = null, $posiljkePoPosiljaocu = [])
    {
        //dd($posiljkePoPosiljaocu);
        $this->posiljke = $posiljke;
        $this->dostava = $dostava;
        $this->posiljkePoPosiljaocu = $posiljkePoPosiljaocu;

        $this->izvestajPoPosiljaocu();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        //dd($this->posiljaociIzvestaj);
        //dd($this->posiljkePoPosiljaocu);
        return view('components.posiljka-tabela', [
            'posiljke' => $this->posiljke, 
            'dostava' => $this->dostava,
            'posiljaociIzvestaj' => $this->posiljaociIzvestaj,
            'posiljkePoPosiljaocu' => $this->posiljkePoPosiljaocu
        ]);
    }

    public function izvestajPoPosiljaocu()
    {
        //dd($this->posiljke);
        foreach ($this->posiljke as $posiljka) {
            if ($posiljka->status_po_spisku == 2) {
                $iznos = (float) $posiljka->vrednost;

                if ($posiljka->nacin_placanja_id == 2 || $posiljka->nacin_placanja_id == 4) {
                    $iznos += (float) $posiljka->postarina;
                }

                if (array_key_exists($posiljka->posiljalac_id, $this->posiljaociIzvestaj)) {
                    $this->posiljaociIzvestaj[$posiljka->posiljalac_id]['ukupan_iznos'] += $iznos;
                    $this->posiljaociIzvestaj[$posiljka->posiljalac_id]['nalog_iznos'] +=  $posiljka->otkupnina_vrsta == 'Nalog za uplatu' ? $iznos : 0;
                    $this->posiljaociIzvestaj[$posiljka->posiljalac_id]['uputnica_iznos'] += $posiljka->otkupnina_vrsta == 'TOP EXPRESS iznos' ? $iznos : 0;
                    $this->posiljaociIzvestaj[$posiljka->posiljalac_id]['urucene_posiljke'][] = $posiljka;
                } else {
                    $this->posiljaociIzvestaj[$posiljka->posiljalac_id] = [
                        'naziv' => $posiljka->posiljalac->naziv,
                        'ukupan_iznos' => $iznos,
                        'nalog_iznos' => $posiljka->otkupnina_vrsta == 'Nalog za uplatu' ? $iznos : 0,
                        'uputnica_iznos' => $posiljka->otkupnina_vrsta == 'TOP EXPRESS iznos' ? $iznos : 0,
                        'urucene_posiljke' => [$posiljka]
                    ];
                }
            }
        }
    }
}
