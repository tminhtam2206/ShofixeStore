<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Order;
use App\Exports\AdvanceExport;
use Excel;

class StatisticalController extends Controller{
    public function basic_today(){
        $order = Order::whereDate('created_at', Carbon::now()->toDateString())->where('status', 'Đã nhận')->get();
        $total_product = 0;
        $total_price = 0;
        $profix_tmp = 0;

        foreach($order as $value){
            $total_price += $value->total;

            foreach(OrderDetailController::show($value->id) as $value_2){
                $total_product += $value_2->amount;

                $profix_tmp += ($value_2->Product->unit_price * $value_2->amount);
            }
        }

        $total_profix = $total_price - $profix_tmp;

        return view('backend.statistical.basic', compact('order', 'total_product', 'total_price', 'total_profix'));
    }

    public function basic_month(){
        $order = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('status', 'Đã nhận')->get();
        $total_product = 0;
        $total_price = 0;
        $profix_tmp = 0;

        foreach($order as $value){
            $total_price += $value->total;

            foreach(OrderDetailController::show($value->id) as $value_2){
                $total_product += $value_2->amount;

                $profix_tmp += ($value_2->Product->unit_price * $value_2->amount);
            }
        }

        $total_profix = $total_price - $profix_tmp;

        return view('backend.statistical.basic', compact('order', 'total_product', 'total_price', 'total_profix'));
    }

    public function basic_year(){
        $order = Order::whereYear('created_at', Carbon::now()->year)->where('status', 'Đã nhận')->get();
        $total_product = 0;
        $total_price = 0;
        $profix_tmp = 0;

        foreach($order as $value){
            $total_price += $value->total;

            foreach(OrderDetailController::show($value->id) as $value_2){
                $total_product += $value_2->amount;

                $profix_tmp += ($value_2->Product->unit_price * $value_2->amount);
            }
        }

        $total_profix = $total_price - $profix_tmp;

        return view('backend.statistical.basic', compact('order', 'total_product', 'total_price', 'total_profix'));
    }

    public function basic_all(){
        $order = Order::where('status', 'Đã nhận')->get();
        $total_product = 0;
        $total_price = 0;
        $profix_tmp = 0;

        foreach($order as $value){
            $total_price += $value->total;

            foreach(OrderDetailController::show($value->id) as $value_2){
                $total_product += $value_2->amount;

                $profix_tmp += ($value_2->Product->unit_price * $value_2->amount);
            }
        }

        $total_profix = $total_price - $profix_tmp;

        return view('backend.statistical.basic', compact('order', 'total_product', 'total_price', 'total_profix'));
    }

    public function advance(){
        return view('backend.statistical.advance');
    }

    public function ajaxFilterAdvance(Request $data){
        // $order = Order::whereDate('created_at', '>', $data->from)->whereDate('created_at', '<', $data->to)->where('status', 'Đã nhận')->orderBy('created_at', 'desc')->get();
        // $order = Order::whereDate('created_at', '>', $data->from)->whereDate('created_at', '<', $data->to)->where('status', 'Đã nhận')->orderBy('created_at', 'desc')->count();

        $order = Order::whereBetween('created_at', [$data->from, $data->to])->where('status', 'Đã nhận')->orderBy('created_at', 'desc')->get();
        $total_order = Order::whereBetween('created_at', [$data->from, $data->to])->where('status', 'Đã nhận')->count();
        $total_product = 0;
        $total_price = 0;
        $profix_tmp = 0;

        $data_return = '';
        $i = 1;

        foreach($order as $value){
            $total_price += $value->total;

            foreach(OrderDetailController::show($value->id) as $value_2){
                $total_product += $value_2->amount;

                $profix_tmp += ($value_2->Product->unit_price * $value_2->amount);
            }

            $data_return .= '<tr>
                <td class="align-middle">'.$i.'</td>
                <td class="align-middle">'.$value->User->name.'</td>
                <td class="align-middle">'.date('d-m-Y H:m:i', strtotime($value->created_at)).'</td>
                <td class="text-center"><span class="badge badge-pill badge-success">'.$value->status.'</span></td>
                <td class="text-center"><span class="badge badge-pill badge-info">'.number_format($value->total).'<sup>đ</sup></span></td>
            </tr>';

            $i++;
        }

        $total_profix = $total_price - $profix_tmp;

        return response()->json([
            'order' => $data_return,
            'total_product' => $total_product,
            'total_price' => number_format($total_price),
            'total_profix' => number_format($total_profix),
            'total_order' => $total_order
        ]);;
    }

    public function ExportAdvance($from, $to){
        return Excel::download(new AdvanceExport($from, $to), 'thong-ke-nang-cao.xlsx');
    }

}
