<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller{
    public static function add($data){
        if(Favourite::where('product_id', $data->id)->where('user_id', Auth::id())->count() == 0){
            $favourite = new Favourite();
            $favourite->product_id = $data->id;
            $favourite->user_id = Auth::id();
            $favourite->save();
        }
    }

    public static function count_favourite_user(){
        return Favourite::where('user_id', Auth::id())->count();
    }

    public static function count_favourite_user_product($product_id){
        return Favourite::where('user_id', Auth::id())->where('product_id', $product_id)->count();
    }

    public static function remove($data){
        Favourite::where('product_id', $data->id)->where('user_id', Auth::id())->delete();
    }

    public static function remove_all(){
        Favourite::where('user_id', Auth::id())->delete();
    }

    public static function show(){
        return Favourite::join('product', 'product.id', '=', 'favourite.product_id')
        ->select('product.*')
        ->get();
    }

    public static function show_to_index(){
        return Favourite::where('user_id', Auth::id())->get();
    }
}
