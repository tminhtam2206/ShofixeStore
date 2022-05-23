<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Banner;

class BannerTop extends Component
{
    public $banner;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->banner = Banner::where('status', 'show')->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.banner-top');
    }
}
