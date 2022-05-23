<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Record;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyAccountController extends Controller{
    public function profile(){
        $my_order = OrderController::count_my_order();
        $my_product_buy = OrderController::count_product_buy();
        $order = OrderController::get_5_order_recent();
        $num_racting = ProductRactingController::count_racting_user();
        $favourite = FavouriteController::count_favourite_user();

        return view('backend.my_account.overview', compact('my_order', 'my_product_buy', 'order', 'num_racting', 'favourite'));
    }

    public function record(){
        $date_now = date('Y-m-d');
        $yester_day = date('Y-m-d',strtotime("-1 days"));
        $two_ago = date('Y-m-d',strtotime("-2 days"));
        
        $today = Record::where('user_id', Auth::user()->id)->whereDate('created_at', $date_now)->orderBy('created_at', 'DESC')->paginate(15);
        $yesterday = Record::where('user_id', Auth::user()->id)->whereDate('created_at', $yester_day)->orderBy('created_at', 'ASC')->paginate(15);
        $two_day_ago = Record::where('user_id', Auth::user()->id)->whereDate('created_at', $two_ago)->orderBy('created_at', 'ASC')->paginate(15);


        return view('backend.my_account.record', compact('today', 'yesterday', 'two_day_ago'));
    }

    public function setting(){
        $address = UserDetailController::show();

        return view('backend.my_account.setting', compact('address'));
    }

    public function changeName(Request $data){
        $user = User::find(Auth::id());
        RecordController::add('Đổi tên từ ['.$user->name.'] thành ['.$data->name.']', $data->ip());
        $user->name = $data->name;
        $user->save();
    }

    public function changeIntroduce(Request $data){
        $user = User::find(Auth::id());
        $user->introduce = $data->introduce;
        $user->save();

        RecordController::add('Thay đổi [giới thiệu bản thân]', $data->ip());
    }

    public function changeAvatar(Request $data){
        $name_avatar = changeAvatar();

        $user = User::find(Auth::id());
        $user->avatar = $name_avatar;
        $user->save();

        RecordController::add('Thay đổi [ảnh đại diện]', $data->ip());

        return asset('storage/app/public/avatar/'.$name_avatar.'?id='.randomCode());
    }

    public function changeEmail(Request $data){
        $user = User::find(Auth::id());

        session()->put('my_choose', 'change_email');

        if(!Hash::check($data->confirmPassword, $user->password)){ 
            return redirect()->route('backend.my_account.setting')->with('errorEmail', 'Xác nhận mật khẩu cũ không đúng');
        }

        RecordController::add('Đổi email từ ['.$user->email.'] thành ['.$data->email.']', $data->ip());
        $user->email = $data->email;
        $user->save();

        return redirect()->route('backend.my_account.setting')->with('successEmail', 'Thay đổi mật khẩu thành công');
    }

    public function changePassword(Request $data){
        $orm = User::find(Auth::id());

        session()->put('my_choose', 'change_password');

        if(!Hash::check($data->oldPassword, $orm->password)){ 
            return redirect()->route('backend.my_account.setting')->with('errorPass', 'Xác nhận mật khẩu cũ không đúng');
        }

        RecordController::add('Thay đổi [mật khẩu]', $data->ip());
        $orm->password = bcrypt($data->newPassword);
        $orm->save();

        return redirect()->route('backend.my_account.setting')->with('successPass', 'Thay đổi mật khẩu thành công');
    }
}
