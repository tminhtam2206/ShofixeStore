<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function index(){
        return view('forgot_password.index');
    }

    public function postSentEmail(Request $request){
        $request->validate([
            'email' => 'required|email|exists:user',
        ]);

        $token = Str::random(60);

        DB::table('password_reset')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('auth.verify',['token' => $token], function($message) use ($request) {
            $message->from($address = 'tminhtam170599@gmail.com', $name = config('app.name'));
            $message->to($request->email);
            $message->subject('ĐẶT LẠI MẬT KHẨU - '.config('app.name'));
        });

        return redirect()->route('forgot.sent_email_success');
    }

    public function sent_email_success(){
        return view('forgot_password.sent_email_success');
    }
}
