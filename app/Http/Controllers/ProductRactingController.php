<?php

namespace App\Http\Controllers;

use App\Models\ProductRacting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRactingController extends Controller{
    public static function add($data){
        $product_racting = new ProductRacting();
        $product_racting->product_id = $data->id;
        $product_racting->user_id = Auth::id();
        $product_racting->marks = $data->marks;
        $product_racting->content = $data->content;
        $product_racting->save();

        ProductController::updateRacting($data->id, ProductRactingController::score_calculation($data->id));
        RecordController::add('Đánh giá sản phẩm ['.$product_racting->Product->name.']', $data->ip());

        $data_marks = '';

        for($i =1; $i<= 5; $i++){
            if($i <= $data->marks){
                $data_marks .= '<i class="fa fa-star"></i>';
            }
            else{
                $data_marks .= '<i class="far fa-star"></i>';
            }
        }

        $data_return = '<div class="media"  style="border-bottom: 1px solid #ddd; margin-bottom: 30px;">
            <div class="media-left media-middle" style="width: 575px;">
                <a href="#">
                    <img class="media-object" src="' . asset('storage/app/public/avatar') . '/' . $product_racting->User->avatar . '" style="width: 50px; height: 50px; border: 1px solid #ddd;">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading" style="font-weight: 700;">
                    <div class="float-left" style="float: left; color: #385898;">'.$product_racting->User->name.'</div>
                    <div class="pro-rating" style="color: gold; float: left; margin-left: 12px;">'.$data_marks.'</div>
                    <div class="date-time" style="float: right; text-align: right; font-weight: 300; font-size: 12px;">'.$product_racting->created_at->diffForHumans().'</div>
                </h4>
                <div class="cls" style="clear: both; margin-bottom: 8px;"></div>
                <p>' . $product_racting->content . '</p>
            </div>
        </div>';

        return $data_return;
    }

    public static function score_calculation($product_id){
        $product_racting = ProductRacting::where('product_id', $product_id)->get();

        $total_marks = 0;
        $count = 0;

        foreach($product_racting as $value){
            $total_marks += $value->marks;
            $count++;
        }

        return round($total_marks/$count);
    }

    public static function show($product_id){
        return ProductRacting::where('product_id', $product_id)->get();
    }

    public static function count_racting_user(){
        return ProductRacting::where('user_id', Auth::id())->count();
    }
}
