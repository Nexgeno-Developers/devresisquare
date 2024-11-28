<?php

namespace App\View\Components\Backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dropdown extends Component
{
    public $class, $options, $isIcon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class=null, $options,$isIcon=false)
    {
        $this->class = $class;
        $this->options = $options;
        $this->isIcon = $isIcon;
    }


    public function render(): View|Closure|string
    {
        return view('backend.components.common.dropdown');
    }
}
