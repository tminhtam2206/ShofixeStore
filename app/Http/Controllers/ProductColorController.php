<?php

namespace App\Http\Controllers;

use App\Models\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller{
    public static function add($id, $color){
        $product_color = new ProductColor();
        $product_color->product_id = $id;
        $product_color->color = $color;
        $product_color->save();
    }

    public static function delete($id){
        ProductColor::where('product_id', $id)->delete();
    }

    public static function show($id){
        return ProductColor::where('product_id', $id)->get();
    }
}
