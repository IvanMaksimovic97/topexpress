<?php

namespace App\View\Components;

use App\Cenovnik;
use App\Ugovor;
use App\VrstaUsluge;
use Illuminate\View\Component;

class UgovorCenovnik extends Component
{
    public $ugovor;
    public $cenovnik;
    public $vrste_usluga;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ugovorid)
    {
        $this->ugovor = Ugovor::find($ugovorid);
        $this->cenovnik = $this->ugovor ? $this->ugovor->getCenovnik() : [];
        $this->vrste_usluga = VrstaUsluge::all(['id', 'naziv']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.ugovor-cenovnik', [
            'ugovor' => $this->ugovor,
            'cenovnik' => $this->cenovnik, 
            'vrste_usluga' => $this->vrste_usluga
        ]);
    }
}
