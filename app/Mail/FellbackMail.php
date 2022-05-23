<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Fellback;

class FellbackMail extends Mailable{
    use Queueable, SerializesModels;
    public $fellback;

    public function __construct(Fellback $fellback){
        $this->fellback = $fellback;
    }

    public function build(){
        return $this->view('email.fellback')->subject('Phản hồi về chúng tôi ' . config('app.name'));
    }
}
