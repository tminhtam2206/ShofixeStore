<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\OrderDetailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Exports\OrderDayExport;
use App\Exports\OrderMonthExport;
use App\Exports\OrderYearExport;
use App\Exports\OrderAllExport;
use App\Models\OrderDetail;
use Excel;
use Cart;

class OrderController extends Controller{
    public function index(){
        $order = Order::orderBy('created_at', 'desc')->get();

        return view('backend.order.index', compact('order'));
    }

    public function peding(){
        $order = Order::where('status', 'Đang duyệt')->orderBy('created_at', 'desc')->get();

        return view('backend.order.index', compact('order'));
    }

    public function approved(){
        $order = Order::where('status', 'Đã duyệt')->orderBy('created_at', 'desc')->get();

        return view('backend.order.index', compact('order'));
    }

    public function success(){
        $order = Order::where('status', 'Đã nhận')->orderBy('created_at', 'desc')->get();

        return view('backend.order.index', compact('order'));
    }

    public function cancel(){
        $order = Order::where('status', 'Hủy đơn')->orderBy('created_at', 'desc')->get();

        return view('backend.order.index', compact('order'));
    }

    public function changeStatus(Request $data){
        $order = Order::find($data->id);
        $order->status = $data->status;
        $order->save();

        if($data->status == 'Hủy đơn'){
            OrderDetailController::return_amount_product($order->id);
        }

        RecordController::add('Đổi trạng thái đơn hàng [#'.$order->id.']', $data->ip());
    }

    public function show_order_detail($id){
        $order_detail = OrderDetailController::show($id);

        return view('backend.order_detail.index', compact('order_detail', 'id'));
    }

    public static function add($data){
        $order = new Order();
        $order->user_id = Auth::id();
        $order->name = $data->name;
        $order->phone = $data->phone;
        $order->address = $data->address;
        $order->note = $data->note;
        $order->total = str_replace('.', '', Cart::total());
        $order->save();

        OrderDetailController::add($order->id);

        Cart::destroy();

        return $order;
    }

    public static function count(){
        return Order::count();
    }

    public static function count_by_user($user_id){
        return Order::where('user_id', $user_id)->count();
    }

    public static function show($order_id){
        return Order::find($order_id);
    }

    public static function order_wait(){
        return Order::where('status', 'Đang duyệt')->count();
    }

    public static function total_order_today(){
        $date = Carbon::now();
        return Order::whereDate('created_at', $date->toDateString())->count();
    }

    public static function order_complete_today(){
        $date = Carbon::now();
        $order = Order::whereDate('created_at', $date->toDateString())->where('status', 'Đã nhận')->count();
        $total = OrderController::total_order_today();

        if($total > 0){
            return round((($order/$total) * 100)); 
        }

        return 0;
    }

    public static function order_cancel_today(){
        $date = Carbon::now();
        $order = Order::whereDate('created_at', $date->toDateString())->where('status', 'Hủy đơn')->count();
        $total = OrderController::total_order_today();

        if($total > 0){
            return round((($order/$total) * 100)); 
        }

        return 0;
    }

    public static function order_wait_today(){
        $date = Carbon::now();
        $order = Order::whereDate('created_at', $date->toDateString())->where('status', 'Đang duyệt')->count();
        $total = OrderController::total_order_today();

        if($total > 0){
            return round((($order/$total) * 100)); 
        }

        return 0;
    }

    public static function showRecentOrder($num){
        $date_current = Carbon::now();
        $days = array();
        $num_product = [0, 0, 0, 0, 0, 0, 0];
        $string_date = "";

        for($i=0; $i < 7; $i++){
            if($i == 0){
                $days[$i] = $date_current->toDateString();
                $string_date .= "'".Carbon::parse($days[$i])->format('d-m-Y')."', ";
            }
            else{
                $days[$i] = $date_current->subDay(1)->toDateString();
                if($i == 6){
                    $string_date .= "'".Carbon::parse($days[$i])->format('d-m-Y')."'";
                }
                else{
                    $string_date .= "'".Carbon::parse($days[$i])->format('d-m-Y')."', ";
                }  
            }
        }

        for($i=0; $i < count($days); $i++){
            foreach(Order::whereDate('created_at', $days[$i])->get() as $value){
                foreach(OrderDetail::where('order_id', $value->id)->get() as $vaL_2){
                    $num_product[$i] += $vaL_2->amount;
                }
            }
        }

        $data_product = collect($num_product)->implode(', ');

        $data_return = [
            'string_date' => $string_date,
            'data_product' => $data_product
        ];

        return $data_return;
    }

    public function export_excel(Request $data){
        RecordController::add('Xuất excel đơn hàng theo ['.$data->type_export.']', $data->ip());

        if($data->type_export == 'day'){
            return Excel::download(new OrderDayExport, 'danh-sach-don-hang-theo-ngay.xlsx');
        }
        else if($data->type_export == 'month'){
            return Excel::download(new OrderMonthExport, 'danh-sach-don-hang-theo-thang.xlsx');
        }
        else if($data->type_export == 'year'){
            return Excel::download(new OrderYearExport, 'danh-sach-don-hang-theo-nam.xlsx');
        }
        else{
            return Excel::download(new OrderAllExport, 'danh-sach-don-hang-tat-ca.xlsx');
        }
    }

    public static function count_my_order(){
        return Order::where('user_id', Auth::id())->count();
    }

    public static function count_product_buy(){
        $result = 0;

        foreach(Order::where('user_id', Auth::id())->get() as $value){
            $result += OrderDetailController::count_product($value->id);
        }

        return $result;
    }

    public static function get_5_order_recent(){
        return Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(5);
    }

    public static function getOrderUser(){
        return Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
    }

    public static function countOrderToDay(){
        return Order::whereDate('created_at', Carbon::now()->toDateString())->count();
    }
}
