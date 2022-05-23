<?php

namespace App\Http\Controllers;

use App\Models\Fellback;
use Illuminate\Http\Request;

class FellbackController extends Controller{
    public function index(){
        $fellback = Fellback::orderBy('created_at', 'desc')->get();

        return view('backend.fellback.index', compact('fellback'));
    }

    public function approval(Request $data){
        if($data->approval == 'YES'){
            $fellback = Fellback::find($data->id);
            $fellback->approval = 'NO';
            $fellback->save();
        }
        else{
            $fellback = Fellback::find($data->id);
            $fellback->approval = 'YES';
            $fellback->save();
        }
    }

    public static function add($data){
        $fellback = new Fellback();
        $fellback->name = $data->name;
        $fellback->email = $data->email;
        $fellback->content = $data->content;
        $fellback->save();

        return $fellback;
    }

    public static function show($num){
        return Fellback::paginate($num);
    }

    public function feedbackSuccessfully(){
        return view('frontend.feedback_successfully');
    }
}
