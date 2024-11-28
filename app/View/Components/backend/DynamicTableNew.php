<?php

namespace App\View\Components\Backend;

use Illuminate\View\Component;

class DynamicTableNew extends Component
{
    public $class, $headers, $rows, $dropdownOptions, $actionBtn;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class=null, $headers, $rows, $dropdownOptions=null, $actionBtn="True")
    {
        $this->class = $class;
        $this->headers = $headers;
        $this->rows = $rows;
        $this->dropdownOptions = $dropdownOptions; //array for dropdown list
        $this->actionBtn = $actionBtn; // True | False
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('backend.components.common.table-new');
    }
}
