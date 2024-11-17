<?php

namespace App\View\Components\backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LinkButton extends Component
{
    public $class, $name, $link;
    public function __construct( $class, $name, $link)
    {
        $this->class = $class;
        $this->name = $name;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('backend.components.link-button');
    }
}
