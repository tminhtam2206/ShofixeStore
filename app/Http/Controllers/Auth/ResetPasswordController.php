<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RecordController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function getPassword($token)
    {

        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',

        ]);

        $updatePassword = DB::table('password_reset')
        ->where(['email' => $request->email, 'token' => $request->token])
        ->first();

        if (!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }
            
        $user = User::where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset')->where(['email' => $request->email])->delete();

        RecordController::add_v2(User::where('email', $request->email)->first()->id, 'Quên mật khẩu', $request->ip());

        return redirect()->route('resetpass.resetPasswordComplete');
    }

    public function resetPasswordComplete(){
        return view('forgot_password.reset_password_success');
    }
}
