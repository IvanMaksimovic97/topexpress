<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UgovorTabela extends Component
{
    public $ugovori;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ugovori)
    {
        $this->ugovori = $ugovori;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.ugovor-tabela', ['ugovori' => $this->ugovori]);
    }
}
