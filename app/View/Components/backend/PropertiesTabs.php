<?php

namespace App\View\Components\backend;
use Illuminate\View\Component;

class PropertiesTabs extends Component
{
    public $tabs;

    /**
     * Create a new component instance.
     *
     * @param array $tabs
     * @return void
     */
    public function __construct($tabs)
    {
        $this->tabs = $tabs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('backend.components.tabs');
    }
}
