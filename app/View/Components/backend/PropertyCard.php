<?php

namespace App\View\Components\backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PropertyCard extends Component
{
    public $class, $propertyName, $bed, $bath, $floor, $living, $price, $type, $available, $propertyId;

    public function __construct($class, $propertyName, $bed, $bath, $floor, $living, $price, $type, $available, $propertyId) {
         $this->class = $class;
         $this->propertyName = $propertyName;
         $this->bed = $bed;
         $this->bath = $bath;
         $this->bath = $bath;
         $this->floor = $floor;
         $this->living = $living;
         $this->price = $price;
         $this->type = $type;
         $this->available = $available;
         $this->propertyId = $propertyId;
        }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('backend.components.property-h-card');
    }
}
