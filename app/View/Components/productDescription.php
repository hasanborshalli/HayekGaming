<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class productDescription extends Component
{
    public $name;
    public $headline;
    public $description;
    public $features;
    public $boxContents;


    public function __construct($headline, $description, $name, $features, $boxContents)
    {
        $this->headline=$headline;
        $this->description=$description;
        $this->name=$name;
        $this->features=$features;
        $this->boxContents=$boxContents;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-description');
    }
}