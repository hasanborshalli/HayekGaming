<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class newProductCard extends Component
{
    public $title;
    public $image;
    public $price;
    public $category;
    public function __construct($title, $image, $price, $category)
    {
        $this->title=$title;
        $this->image=$image;
        $this->price=$price;
        $this->category=$category;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.new-product-card');
    }
}