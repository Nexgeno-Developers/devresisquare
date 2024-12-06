<?php

namespace App\View\Components\Backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputComp extends Component
{
    public $class, $inputName, $inputOpt,$inputType, $rightIcon, $placeHolder, $isLabel,  $label, $isDate, $isIcon, $iconName, $onIconClick ;
    public function __construct($class, $inputName=null, $inputOpt = null, $inputType = "text", $rightIcon=null, $placeHolder=null, $isLabel = false, $label=null, $isDate = false, $isIcon = false,  $iconName = null, $onIconClick="" )
    {
        $this->class = $class;
        $this->inputName = $inputName; //input name
        $this->inputOpt = $inputOpt; //input_prce | inpute_date
        $this->inputType = $inputType; // text | number | date
        $this->rightIcon = $rightIcon; // text | icon
        $this->placeHolder = $placeHolder; 
        $this->isLabel = $isLabel; // True | False
        $this->label = $label; // input Label
        $this->isDate = $isDate; // True | False
        $this->isIcon = $isIcon; // True | False 
        $this->iconName = $iconName; // icon name from bootstrap icon 
        $this->onIconClick = $onIconClick; // for jquery function
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('backend.components.common.input');
    }
}
