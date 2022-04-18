<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PosiljkaTabela extends Component
{
    public $posiljke;
    public $dostava;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posiljke, $dostava = null)
    {
        $this->posiljke = $posiljke;
        $this->dostava = $dostava;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.posiljka-tabela', ['posiljke' => $this->posiljke, 'dostava' => $this->dostava]);
    }
}
