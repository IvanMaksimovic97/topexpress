<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PosiljkaTabela extends Component
{
    public $posiljke;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posiljke)
    {
        $this->posiljke = $posiljke;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.posiljka-tabela', ['posiljke' => $this->posiljke]);
    }
}
