<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class relatedProducts extends Component
{
    public $title;
    public $products;
    public $subId;
    public $isGames;
    public $category;
    public function __construct($title, $products, $subId, $isGames, $category)
    {
        $this->title=$title;
        $this->products=$products;
        $this->subId=$subId;
        $this->isGames=$isGames;
        $this->category=$category;
    }
    //
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.related-products');
    }
}