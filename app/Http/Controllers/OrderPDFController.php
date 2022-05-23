<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use PDF;

class OrderPDFController extends Controller{
    public function print_order_pdf($order_id){
        $order = OrderController::show($order_id);

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'order' => $order,
            'order_detail' => OrderDetailController::show($order_id)
        ];
          
        $pdf = PDF::loadView('order_pdf', $data);
    
        return $pdf->download('Đơn Hàng #'.$order_id.' - '.$order->name.'.pdf');
    }
}
