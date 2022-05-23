<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use App\Models\Record;
use App\Models\User;
use App\Models\TypeProduct;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use App\Mail\OrderConfirmMail;
use App\Mail\FellbackMail;
use App\Models\Brand;
use App\Models\Fellback;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller{
    public function index(){
        $hot = ProductController::getHotProduct();
        $new_product = ProductController::getNewProduct();
        $featured = ProductController::getFeatured();
        $best = ProductController::getNewProduct();
        $my_favourite = FavouriteController::show_to_index();

        return view('frontend.index', compact('new_product', 'featured', 'best', 'hot', 'my_favourite'));
    }

    public function getLogin(){
        return view('frontend.login');
    }

    public function getRegister(){
        return view('frontend.register');
    }

    public function getLogout(){
        Auth::logout();

        return redirect()->route('frontend');
    }

    public function getContact(){
        return view('frontend.contact');
    }

    public function getAboutUs(){
        return view('frontend.about_us');
    }

    public function getProductByBrand($name_slug){
        $category = Category::paginate(8);
        $brand = Brand::paginate(8);

        $product = Brand::join('product', 'product.brand_id', '=', 'brand.id')
        ->select('product.*')->get();

        return view('frontend.type_category', compact('category', 'brand', 'product'));
    }

    public function getProductByCategory($name_slug){
        $category = Category::paginate(8);
        $brand = Brand::paginate(8);

        $product = Category::join('product', 'product.category_id', '=', 'category.id')
        ->select('product.*')->get();

        return view('frontend.type_category', compact('category', 'brand', 'product'));
    }

    public function getProductByTypeProduct($name_slug){
        $category = Category::paginate(8);
        $brand = Brand::paginate(8);

        $product = TypeProduct::join('category', 'type_product.id', '=', 'category.type_product_id')
        ->join('product', 'category.id', '=', 'product.category_id')
        ->select('product.*')
        ->get();

        return view('frontend.type_category', compact('category', 'brand', 'product'));
    }

    public function getProductDetail($name_slug, $id){
        $product = ProductController::getProductDetail($id);
        $product_size = ProductSizeController::show($id);
        $product_color = ProductColorController::show($id);
        $related = ProductController::getRelated($product->category_id);
        $racting = ProductRactingController::show($id);
        $comment = ProductCommentController::show($id);
        $favourite = FavouriteController::count_favourite_user_product($id);

        return view('frontend.product_detail', compact('product', 'product_size', 'product_color', 'related', 'racting', 'comment', 'favourite'));
    }

    public static function ajaxGetDetailProduct($id){
        $product = ProductController::getProductDetail($id);

        $data_return = '
            <div class="modal-body">
                <div class="modal-product">
                    <div class="product-images">
                        <div class="main-image images">
                            <img alt="" src="'.firstProductImage($product->image).'">
                        </div>
                    </div>

                    <div class="product-info">
                        <h1>'.$product->name.'</h1>
                        <div class="price-box">
                            <p class="price"><span class="special-price"><span class="amount">'.disCount($product->discount, $product->price).'₫</span></span></p>
                        </div>
                        <a href="'.route('frontend.product_detail', ['name_slug' => $product->name_slug, 'id' => $product->id]).'" class="see-all">Chi tiết sản phẩm</a>
                        <div class="quick-add-to-cart">
                            <div class="cart">
                                <button class="single-add-to-cart-button" onclick="add_to_cart('.$product->id.')">Thêm vào giỏ</button>
                            </div>
                        </div>
                        <div class="quick-desc">'.$product->summary.' </div>
                        <div class="social-sharing">
                            <div class="widget widget_socialsharing_widget">
                                <h3 class="widget-title-modal">Chia sẽ sản phẩm này</h3>
                                <ul class="social-icons">
                                    <li><a target="_blank" title="Facebook" href="#" class="facebook social-icon"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a target="_blank" title="Twitter" href="#" class="twitter social-icon"><i class="fab fa-twitter"></i></a></li>
                                    <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="fab fa-pinterest-p"></i></a></li>
                                    <li><a target="_blank" title="Google +" href="#" class="gplus social-icon"><i class="fab fa-google-plus-g"></i></a></li>
                                    <li><a target="_blank" title="LinkedIn" href="#" class="linkedin social-icon"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

        return $data_return;
    }

    public function getCheckOut(){
        $user_detail = UserDetailController::show_check_out();

        return view('frontend.checkout', compact('user_detail'));
    }

    public function postCheckOut(Request $data){
        $order = OrderController::add($data);
        UserDetailController::add($data);

        Mail::to(Auth::user()->email)->send(new OrderConfirmMail($order));

        return redirect()->route('frontend');
    }

    public function policy(){
        $policy = PolicyController::show();

        return view('frontend.policy', compact('policy'));
    }

    public function term(){
        $term = TermController::show();

        return view('frontend.term', compact('term'));
    }

    public function search(Request $data){
        $product = ProductController::search_product($data);
        $brand = BrandController::show();
        $category = CategoryController::show();
        $key = $data->key;

        return view('frontend.search', compact('product', 'brand', 'category', 'key'));
    }

    public function search_ajax(Request $data){
        $product = ProductController::search_product_ajax($data);

        $output = '<ul class="submenu-mainmenu" style="display:block; position:relative;">';
        $data_return = '';

        foreach($product as $value){
            $data_return .= '<li style="border-bottom: 1px solid #ddd; padding-top: 12px; padding-bottom: 12px; padding-left: 6px; padding-right: 6px;"><a href="'.route('frontend.product_detail', ['name_slug' => $value->name_slug, 'id' => $value->id]).'" style="color: black;">'.$value->name.'</a></li>';
        }

        return $output.$data_return.'</ul>';
    }

    public function fellback(Request $data){
        $fellback = FellbackController::add($data);
        Mail::to($fellback->email)->send(new FellbackMail($fellback));

        return redirect()->route('frontend.fellback_successfully');
    }

    /* 
    |
    | USER MANAGER 
    |
    */
    public function getUserManager(){
        $load_record = RecordController::getRecord(8);
        $my_order = OrderController::count_my_order();
        $my_product_buy = OrderController::count_product_buy();
        $oder_wait_approval = Order::where('user_id', Auth::id())->where('status', 0)->count();
        $order = Order::orderBy('updated_at', 'desc')->paginate(10);

        return view('frontend_manager.dashboard', compact('load_record', 'my_order', 'my_product_buy', 'oder_wait_approval', 'order'));
    }

    public function getProfileUser(){
        $my_order = OrderController::count_my_order();
        $my_product_buy = OrderController::count_product_buy();
        $order = OrderController::get_5_order_recent();
        $num_racting = ProductRactingController::count_racting_user();
        $favourite = FavouriteController::count_favourite_user();

        return view('frontend_manager.my_account.overview', compact('my_order', 'my_product_buy', 'order', 'num_racting', 'favourite'));
    }

    public function getRecordUser(){
        $date_now = date('Y-m-d');
        $yester_day = date('Y-m-d',strtotime("-1 days"));
        $two_ago = date('Y-m-d',strtotime("-2 days"));
        
        $today = Record::where('user_id', Auth::user()->id)->whereDate('created_at', $date_now)->orderBy('created_at', 'DESC')->paginate(15);
        $yesterday = Record::where('user_id', Auth::user()->id)->whereDate('created_at', $yester_day)->orderBy('created_at', 'ASC')->paginate(15);
        $two_day_ago = Record::where('user_id', Auth::user()->id)->whereDate('created_at', $two_ago)->orderBy('created_at', 'ASC')->paginate(15);


        return view('frontend_manager.my_account.record', compact('today', 'yesterday', 'two_day_ago'));
    }

    public function getSetting(){
        $address = UserDetailController::show();

        return view('frontend_manager.my_account.setting', compact('address'));
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
            return redirect()->route('frontend.my_account.setting')->with('errorEmail', 'Xác nhận mật khẩu cũ không đúng');
        }

        RecordController::add('Đổi email từ ['.$user->email.'] thành ['.$data->email.']', $data->ip());
        $user->email = $data->email;
        $user->save();

        return redirect()->route('frontend.my_account.setting')->with('successEmail', 'Thay đổi mật khẩu thành công');
    }

    public function changePassword(Request $data){
        $orm = User::find(Auth::id());

        session()->put('my_choose', 'change_password');

        if(!Hash::check($data->oldPassword, $orm->password)){ 
            return redirect()->route('frontend.my_account.setting')->with('errorPass', 'Xác nhận mật khẩu cũ không đúng');
        }

        RecordController::add('Thay đổi [mật khẩu]', $data->ip());
        $orm->password = bcrypt($data->newPassword);
        $orm->save();

        return redirect()->route('frontend.my_account.setting')->with('successPass', 'Thay đổi mật khẩu thành công');
    }

    public function getOrderUser(){
        $order = OrderController::getOrderUser();

        return view('frontend_manager.order.index', compact('order'));
    }

    public function show_order_detail($id){
        $order_detail = OrderDetailController::show($id);

        return view('frontend_manager.order_detail.index', compact('order_detail', 'id'));
    }

    public function ajaxAddRacting(Request $data){
        return ProductRactingController::add($data);
    }

    public function ajaxAddComment(Request $data){
        return ProductCommentController::add($data);
    }

    public function ajaxAddFavourite(Request $data){
        FavouriteController::add($data);
    }

    public function ajaxRemoveFavourite(Request $data){
        FavouriteController::remove($data);
    }

    public function getFavourite(){
        $favourite = FavouriteController::show();
        $brand = BrandController::show();
        $category = CategoryController::show();

        return view('frontend.favourite', compact('favourite', 'brand', 'category'));
    }
}