<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermController extends Controller{
    public function index(){
        $term = Term::first();
        
        return view('backend.term', compact('term'));
    }

    public function create(){
        $term = new Term();
        $term->user_post = Auth::user()->name;
        $term->content = 'this is your term!';
        $term->save();

        RecordController::add('Tạo điều khoản mới', '::1');

        return redirect()->route('backend.term');
    }

    public function update(Request $data){
        $term = Term::find($data->id);
        $term->user_post = Auth::user()->name;
        $term->content = $data->content;
        $term->save();

        RecordController::add('Chỉnh sửa điều khoản', $data->ip());

        return redirect()->route('backend.term');
    }

    public static function show(){
        return Term::first();
    }
}
