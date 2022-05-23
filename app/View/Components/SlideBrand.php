<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Brand;

class SlideBrand extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.slide-brand');
    }

    public function brand(){
        return Brand::all();
    }
}
