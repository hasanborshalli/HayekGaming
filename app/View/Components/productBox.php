<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class productBox extends Component
{
    public $title;
    public $price;
    public $id;
    public $image1;
    public $image2;
    public $image3;
    public $image4;
    
    public function __construct($title, $price, $image1, $image2, $image3, $image4, $id)
    {
        $this->title=$title;
        $this->price=$price;
        $this->id=$id;
        $this->image1=$image1;
        $this->image2=$image2;
        $this->image3=$image3;
        $this->image4=$image4;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-box');
    }
}