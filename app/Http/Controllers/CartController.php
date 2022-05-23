<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\ProductColorController;
use App\Models\Product;
use Cart;

class CartController extends Controller{
    public function index(){

        return view('frontend.cart');
    }

    public function add_home(Request $data){
        $product = ProductController::getProductDetail($data->id);

        if($product->exist > 0){
            $product_size = ProductSizeController::show($data->id);
            $product_color = ProductColorController::show($data->id);
    
            $size = '';
            $color = '';
    
            if(count($product_size) > 0){
                $size = $product_size[0]->size;
            }
    
            if(count($product_color) > 0){
                $color = $product_color[0]->color;
            }
    
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
                'weight' => 0,
                'options' => [
                    'image' => firstProductImage($product->image),
                    'size' => $size,
                    'color' => $color,
                    'name_slug' => $product->name_slug,
                    'product_color' => $product_color,
                    'product_size' => $product_size,
                    'discount' => $product->discount,
                    'max' => $product->exist
                ]
            ]);
        }
        else{
            return 'Sản phẩm đã hết hàng trong thời gian ngắn!';
        }
    }

    public function add_product_detail(Request $data){
        $product = ProductController::getProductDetail($data->id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => $data->qty,
            'weight' => 0,
            'options' => [
                'image' => firstProductImage($product->image),
                'size' => $data->size,
                'color' => $data->color,
                'name_slug' => $product->name_slug,
                'max' => $product->exist
            ]
        ]);
    }

    public function up(Request $data){
		$row = Cart::get($data->rowId);

        $product = Product::find($row->id);

        if($product->exist > 0){
            if ($row->qty < 10) {
                if($row->qty < $row->options->max){
                    Cart::update($data->rowId, $row->qty + 1);
                }
            }
        }
		
        return $row->qty;
	}

    public function down(Request $data){
		$row = Cart::get($data->rowId);

		if ($row->qty > 1) {
			Cart::update($data->rowId, $row->qty - 1);
		}

        return $row->qty;
	}

	public function delete(Request $data){
		Cart::remove($data->rowId);
	}

    public function delete_all(){
        Cart::destroy();
        
        return redirect()->route('frontend.cart');
    }

    public function getPrice(Request $data){
        $row = Cart::get($data->rowId);

        return number_format($row->price * $row->qty).'<sup>đ</sup>';
    }

    public function getSubTotal(){
        return Cart::subTotal().'<sup>đ</sup>';
    }

    public function getTotal(){
        return Cart::total().'<sup>đ</sup>';
    }

    public function getCount(){
        return Cart::count();
    }

    public function getContentCart(){
        $data = '';

        foreach(Cart::content() as $value){
            $data .= '<li class="single-cart-item clearfix">
            <span class="cart-img">
                <a href="#"><img src="'.$value->options->image.'" style="width: 50px; height: 59px;"></a>
            </span>
            <span class="cart-info">
                <a href="#">'.$value->name.'</a>
                <span>'.number_format($value->price).' x '.$value->qty.'</span>
            </span>
            <span class="trash-cart">
                <a href="#"><i class="fa fa-trash-o"></i></a>
            </span>
            </li>
            <div id="content-my-cart"></div>';
        }

        return $data;
    }

    public function changeColor(Request $data){
		$row = Cart::get($data->rowId);
        $image = $row->options->image;
        $size = $row->options->size;
        $color = $data->color;
        $name_slug = $row->options->name_slug;
        $product_color = $row->options->product_color;
        $product_size = $row->options->product_size;
        $max = $row->options->max;
        $discount = $row->options->discount;


		Cart::update($data->rowId, ['options' => [
            'image' => $image, 
            'size' => $size,
            'color' => $color,
            'name_slug' => $name_slug,
            'product_color' => $product_color,
            'product_size' => $product_size,
            'discount' => $discount,
            'max' => $max
        ]]);

        return $row->options->color;
	}

    public function changeSize(Request $data){
		$row = Cart::get($data->rowId);
        $image = $row->options->image;
        $size = $data->size;
        $color = $row->options->color;
        $name_slug = $row->options->name_slug;
        $product_color = $row->options->product_color;
        $product_size = $row->options->product_size;
        $max = $row->options->max;
        $discount = $row->options->discount;


		Cart::update($data->rowId, ['options' => [
            'image' => $image, 
            'size' => $size,
            'color' => $color,
            'name_slug' => $name_slug,
            'product_color' => $product_color,
            'product_size' => $product_size,
            'discount' => $discount,
            'max' => $max
        ]]);

        return $row->options->size;
	}
}