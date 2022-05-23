<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller{
    public static function add($action, $ip){
        $record = new Record();
        $record->user_id = Auth::id();
        $record->action = $action;
        $record->ip = $ip;
        $record->save();
    }

    public static function add_v2($user_id, $action, $ip){
        $record = new Record();
        $record->user_id = $user_id;
        $record->action = $action;
        $record->ip = $ip;
        $record->save();
    }

    public static function show($user_id){
        $date_now = date('Y-m-d');
        $yester_day = date('Y-m-d',strtotime("-1 days"));
        $two_ago = date('Y-m-d',strtotime("-2 days"));
        
        $today = Record::where('user_id', Auth::user()->id)->whereDate('created_at', $date_now)->orderBy('created_at', 'DESC')->paginate(15);
        $yesterday = Record::where('user_id', Auth::user()->id)->whereDate('created_at', $yester_day)->orderBy('created_at', 'ASC')->paginate(15);
        $twoday_ago = Record::where('user_id', Auth::user()->id)->whereDate('created_at', $two_ago)->orderBy('created_at', 'ASC')->paginate(15);

        $data_return = array([
            'today' => $today,
            'yesterday' => $yester_day,
            'two_day_ago' => $two_ago
        ]);

        return $data_return;
    }

    public static function count_user($user_id){
        return Record::where('user_id', $user_id)->count();
    }

    public static function getRecord($num){
        return Record::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate($num);
    }
}
