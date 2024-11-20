<?php

namespace App\View\Components\backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dropdown extends Component
{
    public $options, $selected, $class;

    /**
     * Create a new component instance.
     *
     * @param array $options
     * @param string|null $selected
     * @param string|null $class
     * @return void
     */
    public function __construct(array $options, $selected = null,  $class=null)
    {
        $this->class = $class;
        $this->options = $options;
        $this->selected = $selected;
    }



    public function render(): View|Closure|string
    {
        return view('backend.components.common.dropdown');
    }
}
