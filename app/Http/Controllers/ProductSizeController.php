<?php

namespace App\Http\Controllers;

use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    public static function add($id, $size){
        $product_size = new ProductSize();
        $product_size->product_id = $id;
        $product_size->size = $size;
        $product_size->save();
    }

    public static function delete($id){
        ProductSize::where('product_id', $id)->delete();
    }

    public static function show($id){
        return ProductSize::where('product_id', $id)->get();
    }
}
