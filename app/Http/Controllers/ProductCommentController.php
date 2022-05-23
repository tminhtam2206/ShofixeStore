<?php

namespace App\Http\Controllers;

use App\Models\ProductComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCommentController extends Controller{
    public static function add($data){
        $product_cmt = new ProductComment();
        $product_cmt->product_id = $data->id;
        $product_cmt->user_id = Auth::id();
        $product_cmt->content = $data->content;
        $product_cmt->save();

        $data_return = '<div class="media" style="margin-bottom: 30px;">
            <div class="media-left media-middle" style="width: 575px;">
                <a href="#">
                    <img class="media-object" src="' . asset('storage/app/public/avatar') . '/' . $product_cmt->User->avatar . '" style="width: 50px; height: 50px; border: 1px solid #ddd;">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading" style="font-weight: 700;">
                    <div class="float-left" style="float: left; color: #385898;">'.$product_cmt->User->name.'</div>
                    <div class="date-time" style="float: right; text-align: right; font-weight: 300; font-size: 12px;">'.$product_cmt->created_at->diffForHumans().'</div>
                </h4>
                <div class="cls" style="clear: both; margin-bottom: 8px;"></div>
                <p>' . $product_cmt->content . '</p>
            </div>
        </div>';

        return $data_return;
    }

    public static function show($product_id){
        return ProductComment::where('product_id', $product_id)->get();
    }
}
