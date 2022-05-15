<?php

namespace App\View\Components;

use Illuminate\View\Component;

class KompanijaTabela extends Component
{
    public $kompanije;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($kompanije)
    {
        $this->kompanije = $kompanije;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.kompanija-tabela', ['kompanije' => $this->kompanije]);
    }
}
