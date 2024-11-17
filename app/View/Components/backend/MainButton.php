<?php

namespace App\View\Components\backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainButton extends Component
{
    public $class, $name,;
    public function __construct( $class, $name)
    {
        $this->$class = $class;
        $this->$name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('backend.components.button');
    }
}
