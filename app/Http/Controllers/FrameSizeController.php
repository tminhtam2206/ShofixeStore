<?php

namespace App\Http\Controllers;

use App\Models\FrameSize;
use Illuminate\Http\Request;

class FrameSizeController extends Controller{
    public function index(){
        $size = FrameSize::get();

        return view('backend.frame_size.index', compact('size'));
    }

    public function postAdd(Request $data){
        $size = new FrameSize();
        $size->size = $data->size;
        $size->save();

        RecordController::add('Thêm kích thước cơ bản ['.$data->size.']', $data->ip());

        return redirect()->route('backend.frame_size');
    }

    public function postEdit(Request $data){
        $size = FrameSize::find($data->id);
        RecordController::add('Chỉnh sửa kích thước cơ bản ['.$size->size.'] thành ['.$data->size.']', $data->ip());
        $size->size = $data->size;
        $size->save();

        return redirect()->route('backend.frame_size');
    }

    public function delete(Request $data){
        $size = FrameSize::find($data->id);
        RecordController::add('Xóa kích thước cơ bản ['.$size->size.']', $data->ip());
        $size->delete();
    }

    public function Checksize(Request $data){
        return FrameSize::where('size', $data->size)->count();
    }
}
