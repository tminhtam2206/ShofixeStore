<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Cart;
use App\Models\Product;

class OrderDetailController extends Controller{
    public static function add($order_id){
        foreach(Cart::content() as $value){
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order_id;
            $order_detail->product_id = $value->id;
            $order_detail->amount = $value->qty;
            $order_detail->price = $value->price;
            $order_detail->discount = $value->options->discount;
            $order_detail->size = $value->options->size;
            $order_detail->color = $value->options->color;
            $order_detail->save();

            ProductController::update_exist($value->id, $value->qty);
        }
    }

    public static function show($order_id){
        return OrderDetail::where('order_id', $order_id)->get();
    }

    public static function count_product($order_id){
        $total_product = 0;

        foreach(OrderDetail::where('order_id', $order_id)->get() as $value){
            $total_product += $value->amount;
        }

        return  $total_product;
    }

    public static function return_amount_product($order_id){
        foreach(OrderDetail::where('order_id', $order_id)->get() as $value){
            $product = Product::find($value->product_id);
            $product->exist = ($product->exist + $value->amount);
            $product->save();
        }
    }
}
