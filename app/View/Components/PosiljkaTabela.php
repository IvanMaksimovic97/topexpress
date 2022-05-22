<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PosiljkaTabela extends Component
{
    public $posiljke;
    public $dostava;
    public $posiljaociIzvestaj = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posiljke, $dostava = null)
    {
        $this->posiljke = $posiljke;
        $this->dostava = $dostava;

        $this->izvestajPoPosiljaocu();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.posiljka-tabela', [
            'posiljke' => $this->posiljke, 
            'dostava' => $this->dostava,
            'posiljaociIzvestaj' => $this->posiljaociIzvestaj
        ]);
    }

    public function izvestajPoPosiljaocu()
    {
        foreach ($this->posiljke as $posiljka) {
            if (array_key_exists($posiljka->posiljalac_id, $this->posiljaociIzvestaj)) {
                $this->posiljaociIzvestaj[$posiljka->posiljalac_id]['ukupan_iznos'] += (float) $posiljka->vrednost;
                $this->posiljaociIzvestaj[$posiljka->posiljalac_id]['nalog_iznos'] +=  $posiljka->otkupnina_vrsta == 'Nalog za uplatu' ? (float) $posiljka->vrednost : 0;
                $this->posiljaociIzvestaj[$posiljka->posiljalac_id]['uputnica_iznos'] += $posiljka->otkupnina_vrsta == 'TOP EXPRESS uputnica' ? (float) $posiljka->vrednost : 0;
            } else {
                $this->posiljaociIzvestaj[$posiljka->posiljalac_id] = [
                    'naziv' => $posiljka->posiljalac->naziv,
                    'ukupan_iznos' => (float) $posiljka->vrednost,
                    'nalog_iznos' => $posiljka->otkupnina_vrsta == 'Nalog za uplatu' ? (float) $posiljka->vrednost : 0,
                    'uputnica_iznos' => $posiljka->otkupnina_vrsta == 'TOP EXPRESS uputnica' ? (float) $posiljka->vrednost : 0,
                ];
            }
        }
    }
}
