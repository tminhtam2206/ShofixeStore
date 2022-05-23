<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller{
    public function dashboard(){
        //top
        $user_count = UserController::count();
        $product_count = ProductController::count();
        $order_count = OrderController::count();
        $order_wait_count = OrderController::order_wait();

        //between
        $recent_order_product = OrderController::showRecentOrder(7);

        $order_today = OrderController::countOrderToDay();
        $order_wait_process = OrderController::order_wait_today();
        $order_complete_process = OrderController::order_complete_today();
        $order_cancel_process = OrderController::order_cancel_today();

        $count_admin = UserController::role_admin_count();
        $count_staff = UserController::role_staff_count();
        $count_active = UserController::active_count();
        $count_lock = UserController::lock_count();

        //bootom
        $load_record = RecordController::getRecord(8);
        $fellback = FellbackController::show(7);

        return view('backend.dashboard', compact(
            'product_count', 
            'order_count', 
            'order_wait_count', 
            'user_count', 
            'order_wait_process', 
            'order_complete_process', 
            'order_cancel_process', 
            'recent_order_product',
            'count_admin',
            'count_active',
            'count_lock',
            'count_staff',
            'load_record',
            'fellback',
            'order_today'
        ));
    }
}
