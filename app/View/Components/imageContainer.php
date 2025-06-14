<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class imageContainer extends Component
{
    public $image;
    public $mobileImage;
    public $id;
    public function __construct($image, $mobileImage, $id)
    {
        $this->image=$image;
        $this->mobileImage=$mobileImage;
        $this->id=$id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.image-container');
    }
}