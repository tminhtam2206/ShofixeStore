<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PolicyController extends Controller{
    public function index(){
        $policy = Policy::first();
        
        return view('backend.policy', compact('policy'));
    }

    public function create(){
        $policy = new Policy();
        $policy->user_post = Auth::user()->name;
        $policy->content = 'this is your policy!';
        $policy->save();

        RecordController::add('Tạo chính sách mới', '::1');

        return redirect()->route('backend.policy');
    }

    public function update(Request $data){
        $policy = Policy::find($data->id);
        $policy->user_post = Auth::user()->name;
        $policy->content = $data->content;
        $policy->save();

        RecordController::add('Chỉnh sửa chính sách', $data->ip());

        return redirect()->route('backend.policy');
    }

    public static function show(){
        return Policy::first();
    }
}
