<?php

namespace App\View\Components;

use Illuminate\View\Component;

class KorisnikTabela extends Component
{
    public $korisnici;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($korisnici)
    {
        $this->korisnici = $korisnici;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.korisnik-tabela', ['korisnici' => $this->korisnici]);
    }
}
