<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RadnikTabela extends Component
{
    public $radnici;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($radnici)
    {
        $this->radnici = $radnici;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.radnik-tabela', ['radnici' => $this->radnici]);
    }
}
