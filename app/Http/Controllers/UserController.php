<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller{
    public function active(){
        $user = User::where('status', 'active')->get();

        return view('backend.user.index', compact('user'));
    }

    public function lock(){
        $user = User::where('status', 'lock')->get();

        return view('backend.user.index', compact('user'));
    }

    public function all(){
        $user = User::get();

        return view('backend.user.index', compact('user'));
    }

    public function checkEmail(Request $data){
        return User::where('email', $data->email)->count();
    }

    public function changeStatus(Request $data){
        $user = User::find($data->id);
        $user->status = $data->status;
        $user->save();

        RecordController::add('Đổi trạng thái tài khoản ['.$user->name.'] thành ['.$data->status.']', $data->ip());
    }

    public function changeRole(Request $data){
        $user = User::find($data->id);
        $user->role = $data->role;
        $user->save();

        RecordController::add('Đổi quyền tài khoản ['.$user->name.'] thành ['.$data->role.']', $data->ip());
    }

    public function resetPassword(Request $data){
        $user = User::find($data->id);

        $user->password = bcrypt('00000000');
        $user->save();

        RecordController::add('Đặt lại mật khẩu tài khoản ['.$user->name.']', $data->ip());
    }

    public function add(Request $data){
        $user = new User();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = bcrypt($data->password);
        $user->save();

        RecordController::add('Thêm tài khoản ['.$data->name.']', $data->ip());

        return redirect()->route('backend.user.active');
    }

    public function delete(Request $data){
        $user = User::find($data->id);
        
        if(OrderController::count_by_user($data->id) > 0 && RecordController::count_user($data->id) > 0){
            return false;
        }
        else{
            RecordController::add('Xóa tài khoản ['.$user->name.']', $data->ip());
            $user->delete();

            return true;
        }
    }

    public static function count(){
        return User::count();
    }

    public static function role_admin_count(){
        return User::where('role', 'admin')->count();
    }

    public static function active_count(){
        return User::where('status', 'active')->count();
    }

    public static function lock_count(){
        return User::where('status', 'lock')->count();
    }

    public static function role_staff_count(){
        return User::where('role', 'staff')->count();
    }
}
