<?php

namespace App\Http\Controllers;

use App\Models\FrameColor;
use Illuminate\Http\Request;

class FrameColorController extends Controller{
    public function index(){
        $color = FrameColor::get();

        return view('backend.frame_color.index', compact('color'));
    }

    public function postAdd(Request $data){
        $color = new FrameColor();
        $color->color = $data->color;
        $color->save();

        RecordController::add('Thêm màu cơ bản ['.$data->color.']', $data->ip());

        return redirect()->route('backend.frame_color');
    }

    public function postEdit(Request $data){
        $color = FrameColor::find($data->id);
        RecordController::add('Chỉnh sửa màu cơ bản ['.$color->color.'] thành ['.$data->color.']', $data->ip());
        $color->color = $data->color;
        $color->save();

        return redirect()->route('backend.frame_color');
    }

    public function delete(Request $data){
        $fream_color = FrameColor::find($data->id);
        RecordController::add('Xóa màu cơ bản ['.$fream_color->color.']', $data->ip());
        $fream_color->delete();
    }

    public function CheckColor(Request $data){
        return FrameColor::where('color', $data->color)->count();
    }
}
