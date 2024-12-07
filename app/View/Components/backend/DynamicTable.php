<?php

namespace App\View\Components\Backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DynamicTable extends Component
{
    public $headers, $rows, $class, $actionBtn;
    public function __construct(array $headers, array $rows , $class=null, $actionBtn = True)
    {
        $this->headers = $headers;
        $this->rows = $rows;
        $this->class = $class;
        $this->actionBtn = $actionBtn; // True | False
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('backend.components.common.table');
    }
}