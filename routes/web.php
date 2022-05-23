<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrameColorController;
use App\Http\Controllers\FrameSizeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TypeProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderPDFController;
use App\Http\Controllers\StatisticalController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\FellbackController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BannerController;

Auth::routes();

/*
|--------------------------------------------------------------------------
| Home Controller
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('frontend');

Route::get('/dang-nhap', [HomeController::class, 'getLogin'])->name('frontend.login');
Route::get('/dang-ky', [HomeController::class, 'getRegister'])->name('frontend.register');
Route::get('/dang-xuat', [HomeController::class, 'getLogout'])->name('frontend.logout');

Route::get('/san-pham/{name_slug}/{id}', [HomeController::class, 'getProductDetail'])->name('frontend.product_detail');
Route::get('/ajax-get-product/{id}', [HomeController::class, 'ajaxGetDetailProduct']);

Route::get('/chinh-sach-bao-mat', [HomeController::class, 'policy'])->name('frontend.policy');
Route::get('/dieu-khoan-su-dung', [HomeController::class, 'term'])->name('frontend.term');

Route::get('/tim-kiem', [HomeController::class, 'search'])->name('frontend.search');
Route::post('/tim-kiem/ajax', [HomeController::class, 'search_ajax'])->name('frontend.search_ajax');

Route::get('/lien-he', [HomeController::class, 'getContact'])->name('frontend.contact');
Route::get('/ve-chung-toi', [HomeController::class, 'getAboutUs'])->name('frontend.about_us');
Route::get('/de-lai-loi-nhan-thanh-cong', [ContactController::class, 'success'])->name('frontend.contact.success');
Route::post('/de-lai-loi-nhan', [ContactController::class, 'postAdd'])->name('frontend.contatct_post');

Route::post('/phan-hoi-ve-chung-toi', [HomeController::class, 'fellback'])->name('frontend.fellback');
Route::get('/phan-hoi-thanh-cong', [FellbackController::class, 'feedbackSuccessfully'])->name('frontend.fellback_successfully');

Route::get('/loai-san-pham/{name_slug}', [HomeController::class, 'getProductByTypeProduct'])->name('frontend.type_product');
Route::get('/danh-muc/{name_slug}', [HomeController::class, 'getProductByCategory'])->name('frontend.category');
Route::get('/thuong-hieu/{name_slug}', [HomeController::class, 'getProductByBrand'])->name('frontend.brand');

/*
|--------------------------------------------------------------------------
| Cart Controller
|--------------------------------------------------------------------------
*/
Route::get('/gio-hang', [CartController::class, 'index'])->name('frontend.cart');
Route::get('/gio-hang/getCount', [CartController::class, 'getCount'])->name('frontend.cart.getCount');
Route::get('/gio-hang/getContentCart', [CartController::class, 'getContentCart'])->name('frontend.cart.getContentCart');
Route::get('/gio-hang/add-home', [CartController::class, 'add_home'])->name('frontend.cart.add_home');
Route::get('/gio-hang/up', [CartController::class, 'up'])->name('frontend.cart.up');
Route::get('/gio-hang/down', [CartController::class, 'down'])->name('frontend.cart.down');
Route::get('/gio-hang/getPrice', [CartController::class, 'getPrice'])->name('frontend.cart.getPrice');
Route::get('/gio-hang/getSubTotal', [CartController::class, 'getSubTotal'])->name('frontend.cart.getSubTotal');
Route::get('/gio-hang/getTotal', [CartController::class, 'getTotal'])->name('frontend.cart.getTotal');
Route::get('/gio-hang/changeColor', [CartController::class, 'changeColor'])->name('frontend.cart.changeColor');
Route::get('/gio-hang/changeSize', [CartController::class, 'changeSize'])->name('frontend.cart.changeSize');
Route::get('/gio-hang/delete', [CartController::class, 'delete'])->name('frontend.cart.delete');
Route::get('/gio-hang/delete-all', [CartController::class, 'delete_all'])->name('frontend.cart.delete_all');

/*
|--------------------------------------------------------------------------
| Forgot and Reset Password Controller
|--------------------------------------------------------------------------
*/
Route::get('/quen-mat-khau', [ForgotPasswordController::class, 'index'])->name('forgot.index');
Route::post('/quen-mat-khau/post', [ForgotPasswordController::class, 'postSentEmail'])->name('forgot.index.post');
Route::get('/gui-email-thanh-cong', [ForgotPasswordController::class, 'sent_email_success'])->name('forgot.sent_email_success');

Route::get('/khoi-phuc-mat-khau/{token}', [ResetPasswordController::class, 'getPassword'])->name('resetpass.getPassword');
Route::post('/khoi-phuc-mat-khau', [ResetPasswordController::class, 'updatePassword'])->name('resetpass.postUpdatePassword');
Route::get('/khoi-phuc-mat-khau-thanh-cong', [ResetPasswordController::class, 'resetPasswordComplete'])->name('resetpass.resetPasswordComplete');


/*
|--------------------------------------------------------------------------
| Login to use
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function(){
    Route::get('/dat-hang', [HomeController::class, 'getCheckOut'])->name('frontend.check_out');
    Route::post('/dat-hang/post', [HomeController::class, 'postCheckOut'])->name('frontend.post_check_out');
    Route::post('/danh-gia', [HomeController::class, 'ajaxAddRacting'])->name('frontend.racting');
    Route::post('/binh-luan', [HomeController::class, 'ajaxAddComment'])->name('frontend.comment');
    Route::get('/yeu-thich/them', [HomeController::class, 'ajaxAddFavourite'])->name('frontend.favourite.add');
    Route::get('/yeu-thich/xoa', [HomeController::class, 'ajaxRemoveFavourite'])->name('frontend.favourite.delete');

    //Favourite
    Route::get('/yeu-thich', [HomeController::class, 'getFavourite'])->name('frontend.favourite');

    //User Manager
    Route::get('/bang-dieu-khien', [HomeController::class, 'getUserManager'])->name('frontend.user_manager');

    //My User Account
    Route::get('/tai-khoan/ho-so', [HomeController::class, 'getProfileUser'])->name('frontend.my_account.profile');
    Route::get('/tai-khoan/nhat-ky-hoat-dong', [HomeController::class, 'getRecordUser'])->name('frontend.my_account.record');
    Route::get('/tai-khoan/thiet-lap', [HomeController::class, 'getSetting'])->name('frontend.my_account.setting');
    Route::post('/tai-khoan/doi-ten', [HomeController::class, 'changeName'])->name('frontend.my_account.chang_name');
    Route::post('/tai-khoan/doi-gioi-thieu-ban-than', [HomeController::class, 'changeIntroduce'])->name('frontend.my_account.chang_introduce');
    Route::post('/tai-khoan/doi-anh-dai-dien', [HomeController::class, 'changeAvatar'])->name('frontend.my_account.change_avatar');
    Route::post('/tai-khoan/doi-email', [HomeController::class, 'changeEmail'])->name('frontend.my_account.change_email');
    Route::post('/tai-khoan/doi-mat-khau', [HomeController::class, 'changePassword'])->name('frontend.my_account.change_pass');

    //change address default
    Route::get('/doi-dia-chi-mac-dinh', [UserDetailController::class, 'updateAddress'])->name('frontend.my_account.updateAddress');

    // My User Order
    Route::get('/don-hang', [HomeController::class, 'getOrderUser'])->name('frontend.order');
    Route::get('/don-hang/don-hang-chi-tiet/{id}', [HomeController::class, 'show_order_detail'])->name('frontend.order.detail');
});

/*
|--------------------------------------------------------------------------
| Check Email
|--------------------------------------------------------------------------
*/

Route::post('/check-email', [UserController::class, 'checkEmail'])->name('frontend.check_email');

/*
|--------------------------------------------------------------------------
| Admin Controller
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('backend');

    //Frame Color
    Route::get('/genaral/color', [FrameColorController::class, 'index'])->name('backend.frame_color');
    Route::post('/genaral/color/add', [FrameColorController::class, 'postAdd'])->name('backend.frame_color.add');
    Route::post('/genaral/color/edit', [FrameColorController::class, 'postEdit'])->name('backend.frame_color.edit');
    Route::post('/genaral/color/delete', [FrameColorController::class, 'delete'])->name('backend.frame_color.delete');
    Route::post('/genaral/color/check', [FrameColorController::class, 'CheckColor'])->name('backend.frame_color.check');

    //Frame Size
    Route::get('/genaral/size', [FrameSizeController::class, 'index'])->name('backend.frame_size');
    Route::post('/genaral/size/add', [FrameSizeController::class, 'postAdd'])->name('backend.frame_size.add');
    Route::post('/genaral/size/edit', [FrameSizeController::class, 'postEdit'])->name('backend.frame_size.edit');
    Route::post('/genaral/size/delete', [FrameSizeController::class, 'delete'])->name('backend.frame_size.delete');
    Route::post('/genaral/size/check', [FrameSizeController::class, 'Checksize'])->name('backend.frame_size.check');

    //Type Product
    Route::get('/type-product', [TypeProductController::class, 'index'])->name('backend.type_product');
    Route::post('/type-product/add', [TypeProductController::class, 'postAdd'])->name('backend.type_product.add');
    Route::post('/type-product/edit', [TypeProductController::class, 'postEdit'])->name('backend.type_product.edit');
    Route::post('/type-product/delete', [TypeProductController::class, 'delete'])->name('backend.type_product.delete');
    Route::post('/type-product/check', [TypeProductController::class, 'check'])->name('backend.type_product.check');

    //Category
    Route::get('/category', [CategoryController::class, 'index'])->name('backend.category');
    Route::post('/category/add', [CategoryController::class, 'postAdd'])->name('backend.category.add');
    Route::post('/category/edit', [CategoryController::class, 'postEdit'])->name('backend.category.edit');
    Route::post('/category/delete', [CategoryController::class, 'delete'])->name('backend.category.delete');
    Route::post('/category/check', [CategoryController::class, 'check'])->name('backend.category.check');

    //Brand
    Route::get('/brand', [BrandController::class, 'index'])->name('backend.brand');
    Route::post('/brand/add', [BrandController::class, 'postAdd'])->name('backend.brand.add');
    Route::post('/brand/edit', [BrandController::class, 'postEdit'])->name('backend.brand.edit');
    Route::post('/brand/delete', [BrandController::class, 'delete'])->name('backend.brand.delete');
    Route::post('/brand/check', [BrandController::class, 'check'])->name('backend.brand.check');

    //Product
    Route::get('/product/approval', [ProductController::class, 'approval'])->name('backend.product.approval');
    Route::get('/product/pending', [ProductController::class, 'pending'])->name('backend.product.pending');
    Route::get('/product/all', [ProductController::class, 'all'])->name('backend.product');
    Route::get('/product/add', [ProductController::class, 'getAdd'])->name('backend.product.add');
    Route::get('/product/edit/{id}', [ProductController::class, 'getEdit'])->name('backend.product.edit');
    Route::post('/product/post-add', [ProductController::class, 'postAdd'])->name('backend.product.post_add');
    Route::get('/product/edit/{id}', [ProductController::class, 'getEdit'])->name('backend.product.edit');
    Route::post('/product/post-edit', [ProductController::class, 'postEdit'])->name('backend.product.post_edit');
    Route::post('/product/get-category', [ProductController::class, 'getCategory'])->name('backend.product.get_category');
    Route::post('/product/check-code', [ProductController::class, 'checkCode'])->name('backend.product.check_code');
    Route::post('/product/edit-status', [ProductController::class, 'editStatus'])->name('backend.product.edit_status');
    Route::post('/product/edit-approval', [ProductController::class, 'editApproval'])->name('backend.product.edit_approval');
    Route::post('/product/delete', [ProductController::class, 'delete'])->name('backend.product.delete');

    //Order
    Route::get('/order/pending', [OrderController::class, 'peding'])->name('backend.order.pending');
    Route::get('/order/approved', [OrderController::class, 'approved'])->name('backend.order.approved');
    Route::get('/order/success', [OrderController::class, 'success'])->name('backend.order.success');
    Route::get('/order/cancel', [OrderController::class, 'cancel'])->name('backend.order.cancel');
    Route::get('/order/all', [OrderController::class, 'index'])->name('backend.order');
    Route::get('/order/change', [OrderController::class, 'changeStatus'])->name('backend.order.change_status');
    Route::get('/order/show-detail/{id}', [OrderController::class, 'show_order_detail'])->name('backend.order.show_detail');
    Route::get('/order/print-pdf/{order_id}', [OrderPDFController::class, 'print_order_pdf'])->name('backend.order.print_pdf');
    Route::get('/order/export-excel', [OrderController::class, 'export_excel'])->name('backend.order.export_excel');

    //Statistical
    Route::get('/statistical/basic/today', [StatisticalController::class, 'basic_today'])->name('backend.statistical.basic_today');
    Route::get('/statistical/basic/month', [StatisticalController::class, 'basic_month'])->name('backend.statistical.basic_month');
    Route::get('/statistical/basic/year', [StatisticalController::class, 'basic_year'])->name('backend.statistical.basic_year');
    Route::get('/statistical/basic/all', [StatisticalController::class, 'basic_all'])->name('backend.statistical.basic_all');
    Route::get('/statistical/advance', [StatisticalController::class, 'advance'])->name('backend.statistical.advance');
    Route::get('/statistical/advance/filter', [StatisticalController::class, 'ajaxFilterAdvance'])->name('backend.statistical.advance.filter');
    Route::get('/statistical/advance/filter/export/{from}/{to}', [StatisticalController::class, 'ExportAdvance'])->name('backend.statistical.advance.filter.export');

    //My Account
    Route::get('/my-account/profile', [MyAccountController::class, 'profile'])->name('backend.my_account.profile');
    Route::get('/my-account/record', [MyAccountController::class, 'record'])->name('backend.my_account.record');
    Route::get('/my-account/setting', [MyAccountController::class, 'setting'])->name('backend.my_account.setting');
    Route::post('/my-account/setting/change-name', [MyAccountController::class, 'changeName'])->name('backend.my_account.setting.change_name');
    Route::post('/my-account/setting/change-introduce', [MyAccountController::class, 'changeIntroduce'])->name('backend.my_account.setting.change_introduce');
    Route::post('/my-account/setting/change-avatar', [MyAccountController::class, 'changeAvatar'])->name('backend.my_account.setting.change_avatar');
    Route::post('/my-account/setting/change-email', [MyAccountController::class, 'changeEmail'])->name('backend.my_account.setting.change_email');
    Route::post('/my-account/setting/change-password', [MyAccountController::class, 'changePassword'])->name('backend.my_account.setting.change_password');

    //List User
    Route::get('/user/active', [UserController::class, 'active'])->name('backend.user.active');
    Route::get('/user/lock', [UserController::class, 'lock'])->name('backend.user.lock');
    Route::get('/user/all', [UserController::class, 'all'])->name('backend.user.all');
    Route::post('/user/change-status', [UserController::class, 'changeStatus'])->name('backend.user.change_status');
    Route::post('/user/change-role', [UserController::class, 'changeRole'])->name('backend.user.change_role');
    Route::post('/user/reset-password', [UserController::class, 'resetPassword'])->name('backend.user.reset_password');
    Route::post('/user/add', [UserController::class, 'add'])->name('backend.user.add');
    Route::post('/user/delete', [UserController::class, 'delete'])->name('backend.user.delete');

    //Policy
    Route::get('/policy-term/policy', [PolicyController::class, 'index'])->name('backend.policy');
    Route::get('/policy-term/policy/create', [PolicyController::class, 'create'])->name('backend.policy.create');
    Route::post('/policy-term/policy/update', [PolicyController::class, 'update'])->name('backend.policy.update');

    //Term
    Route::get('/policy-term/term', [TermController::class, 'index'])->name('backend.term');
    Route::get('/policy-term/term/create', [TermController::class, 'create'])->name('backend.term.create');
    Route::post('/policy-term/term/update', [TermController::class, 'update'])->name('backend.term.update');

    //Feedback
    Route::get('/fellback', [FellbackController::class, 'index'])->name('backend.fellback');
    Route::get('/fellback/approval', [FellbackController::class, 'approval'])->name('backend.fellback.approval');

    //Banner
    Route::get('/basic/banner', [BannerController::class, 'index'])->name('backend.banner');
});