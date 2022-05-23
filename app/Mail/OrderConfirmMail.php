<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderConfirmMail extends Mailable{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order){
        $this->order = $order; 
    }
 
    public function build(){
        return $this->view('email.send_mail')->subject('Đặt hàng thành công tại ' . config('app.name'));
    }
}
