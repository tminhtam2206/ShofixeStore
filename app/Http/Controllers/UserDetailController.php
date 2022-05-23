<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDetailController extends Controller
{
    public static function add($data){
        if(UserDetail::where('user_id', Auth::id())->count() == 0){
            $detail = new UserDetail();
            $detail->user_id= Auth::id();
            $detail->name = $data->name;
            $detail->phone = $data->phone;
            $detail->address = $data->address;
            $detail->status = 'YES';
            $detail->save();
        }
        else{
            if(UserDetailController::check($data)){
                $detail = new UserDetail();
                $detail->user_id= Auth::id();
                $detail->name = $data->name;
                $detail->phone = $data->phone;
                $detail->address = $data->address;
                $detail->status = 'NO';
                $detail->save();
            }
        }    
    }

    public static function check($data){
        foreach(UserDetail::where('user_id', Auth::id())->get() as $value){
            if($value->name == $data->name && $value->phone == $data->phone && $value->address == $data->address){
                return false;
                //đã tồn tại
            }
        }

        return true;
    }

    public function updateAddress(Request $data){
        foreach(UserDetail::where('user_id', Auth::id())->get() as $value){
            $detail = UserDetail::find($value->id);
            $detail->status = 'NO';
            $detail->save();
        }

        $detail = UserDetail::find($data->id);
        $detail->status = 'YES';
        $detail->save();
    }

    public static function show_check_out(){
        return UserDetail::where('user_id', Auth::id())->where('status', 'YES')->first();
    }

    public static function show(){
        return UserDetail::where('user_id', Auth::id())->get();
    }
}
