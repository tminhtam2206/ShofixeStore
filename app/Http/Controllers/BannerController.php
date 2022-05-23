<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(){
        $banner = Banner::get();

        return view('backend.banner.index', compact('banner'));
    }
}
