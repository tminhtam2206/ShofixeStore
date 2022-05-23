<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shofixe Store | @yield('title', 'Trang Chủ')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Trần Minh Tâm">
    <meta name="Code" content="DTH175190">
    <meta name="course" content="18TH1">
    <meta name="email" content="devnguhoc@gmail.com">

    <!-- comment facebook -->
    <meta property="fb:app_id" content="361231344504986" />
    <meta property="fb:admins" content="100035917283116" />
    <meta name="robots" content="index, follow">

    <!-- favicon ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/logo/logo.jpg') }}">

    <!-- Bootstrap CSS ============================================ -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.min.css') }}">

    <!-- Nivo slider CSS ============================================ -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/lib/custom-slider/css/nivo-slider.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/lib/custom-slider/css/preview.css') }}" media="screen" />

    <!-- Fontawsome CSS ============================================ -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/font-awesome.min.css') }}">

    <!-- material iconic CSS ============================================ -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/material-design-iconic-font.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/material-design-iconic-font.min.css') }}">

    <!-- owl.carousel CSS ============================================ -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/owl.carousel.css') }}">

    <!-- jquery-ui CSS ============================================ -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery-ui.css') }}">

    <!-- meanmenu CSS ============================================ -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/meanmenu.min.css') }}">

    <!-- animate CSS ============================================ -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/animate.css') }}">

    <!-- Animate headline CSS ============================================ -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/animate-heading.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/reset.css') }}">

    <!-- Video CSS ============================================ -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.mb.YTPlayer.css') }}">

    <!-- style CSS ============================================ -->
    <link rel="stylesheet" href="{{ asset('public/frontend/style.css') }}">

    <!-- responsive CSS ============================================ -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/responsive.css') }}">

    <!-- modernizr JS ============================================ -->
    <script src="{{ asset('public/frontend/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/custom-alert.css') }}">
    <style>
        #my-data-search-ajax li:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <input type="text" id="my_token" value="{{ csrf_token() }}" hidden>
    <!-- Pre Loader ============================================ -->
    <div class="preloader">
        <div class="loading-center">
            <div class="loading-center-absolute">
                <div class="object object_one"></div>
                <div class="object object_two"></div>
                <div class="object object_three"></div>
            </div>
        </div>
    </div>

    <div class="as-mainwrapper">
        <div class="bg-white">
            <!-- header start -->
            <header class="header-area">
                <div class="header-top-area ptb-10 hidden-sm hidden-xs">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="account-usd text-left">
                                    <ul>
                                        <li class="currency"><a href="#">VNĐ <i class="fa fa-angle-down"></i></a>
                                            <ul class="submenu-mainmenu">
                                                <li><a href="#"><i class="fa fa-dollar"></i>USD</a></li>
                                                <li><a href="#"><i class="fa fa-euro"></i>EURO</a></li>
                                                <li><a href="#"><i class="fa fa-gbp"></i>GBP</a></li>
                                            </ul>
                                        </li>
                                        <li class="language"><a href="#"><img src="{{ asset('public/images/vn.png') }}" alt="">Việt Nam <i class="fa fa-angle-down"></i></a>
                                            <ul class="submenu-mainmenu">
                                                <li><a href="#"><img src="{{ asset('public/frontend/img/icon/eng.jpg') }}" alt="">English</a></li>
                                                <li><a href="#"><img src="{{ asset('public/frontend/img/icon/ger.jpg') }}" alt="">German</a></li>
                                                <li><a href="#"><img src="{{ asset('public/frontend/img/icon/fren.jpg') }}" alt="">French</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="social-icons text-center">
                                    <ul>
                                        <li><a href="https://www.facebook.com/profile.php?id=100032359117436"><i class="fab fa-facebook-square"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google-plus-square"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram-square"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="top-right">
                                    <div class="top-login-cart">
                                        <ul>
                                            @guest
                                            <li class=" hidden-xs"><a href="{{ route('frontend.login') }}"><i class="fas fa-user"></i> Đăng Nhập</a></li>
                                            <li class=" hidden-xs"><a href="{{ route('frontend.register') }}"><i class="fas fa-user-plus"></i> Đăng Ký</a></li>
                                            @else
                                            <li class=" hidden-xs"><a href="{{ route('frontend.favourite') }}"><i class="fas fa-kiss-wink-heart"></i> Yêu Thích</a></li>
                                            <li>
                                                @if(Auth::user()->role == 'user')
                                                <a href="{{ route('frontend.user_manager') }}"><i class="fas fa-user"></i> Tài khoản</a>
                                                @else
                                                <a href="{{ route('backend') }}"><i class="fas fa-user-tie"></i> Trang Quản Trị</a>
                                                @endif
                                            </li>
                                            @endguest
                                            <li>
                                                <a href="#"><i class="fas fa-shopping-cart"></i> Giỏ Hàng (<span id="num_cart">{{ Cart::count() }}</span>)</a>
                                                <ul class="submenu-mainmenu">

                                                    <div id="frame-cart">
                                                        <!-- start loop cart -->
                                                        @foreach(Cart::content() as $value)
                                                        <li class="single-cart-item clearfix">
                                                            <span class="cart-img">
                                                                <a href="#"><img src="{{ $value->options->image }}" style="width: 50px; height: 59px;"></a>
                                                            </span>
                                                            <span class="cart-info">
                                                                <a href="#">{{ $value->name }}</a>
                                                                <span>{{ number_format($value->price) }} x {{ $value->qty }}</span>
                                                            </span>
                                                            <span class="trash-cart">
                                                                <a href="#"><i class="fa fa-trash-o"></i></a>
                                                            </span>
                                                        </li>
                                                        <div id="content-my-cart"></div>
                                                        @endforeach
                                                        <!-- end loop cart -->
                                                    </div>

                                                    <li>
                                                        <span class="sub-total-cart text-center">
                                                            Tổng tiền: <span id="my-sub-total">{{ Cart::subTotal() }}<sup>đ</sup></span>
                                                            <a href="{{ route('frontend.cart') }}" class="view-cart active" style="width: 100%; color: #fff; background-color: #007bff; border-color: #007bff; border-radius: 3px;"><i class="fas fa-shopping-cart"></i> Xem giỏ hàng</a>
                                                            <a href="{{ route('frontend.check_out') }}" class="view-cart" style="width: 100%; background-color: #b78a28; border-color: #b78a28; color: #fff; border-radius: 3px; margin-top: 5px;">Thanh toán</a>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="logo-info-area ptb-35">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="header-logo">
                                    <a href="{{ route('frontend') }}"><img src="{{ asset('public/frontend/img/logo/1.png') }}" alt="shofixe"></a>
                                </div>
                            </div>
                            <div class="col-md-3 hidden-sm hidden-xs">
                                <div class="info">
                                    <div class="info-icon">

                                    </div>
                                    <div class="info-text">
                                        <h4>(033) 389 4499</h4>
                                        <p>Chúng tôi mở cửa từ 9 am - 10pm</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 hidden-sm hidden-xs">
                                <div class="info">
                                    <div class="info-icon">

                                    </div>
                                    <div class="info-text">
                                        <h4>devnguhoc@gmail.com</h4>
                                        <p>Bạn có thể gửi thư cho chúng tôi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="search-box">
                                    <img src="{{ asset('public/frontend/img/icon/search.png') }}" alt="">
                                    <form method="get" action="{{ route('frontend.search') }}">
                                        <input id="form-search-ajax" type="text" name="key" autocomplete="off" placeholder="Tìm kiếm..." style="font-family: Arial, Helvetica, sans-serif;">
                                        <div id="my-data-search-ajax" style="margin-top: 6px; 
                                        width: 100%; 
                                        background-color: #FFF;
                                        box-shadow: 0 2px 3px rgb(0 0 0 / 30%); 
                                        position: absolute;
                                        text-align: left;
                                        transition: all 0.6s ease 0s;
                                        border: 1px solid #C5C5C5;
                                        z-index: 159;"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mainmenu-area text-center hidden-sm hidden-xs">
                    <nav>
                        <div class="mainmenu">
                            <ul>
                                <li>
                                    <a href="{{ asset('') }}">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="#">Loại Thời Trang</a>
                                    <x-type-product-header></x-type-product-header>
                                </li>
                                <li class="shop"><a href="shop-grid-right-sidebar.html">QUÀ TẶNG</a>
                                    <ul class="submenu-mainmenu">
                                        <li><a href="#"><i class="fa fa-circle"></i>Diệp 8/3</a></li>
                                        <li><a href="#"><i class="fa fa-circle"></i>Tết</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ asset('') }}">Nam</a></li>
                                <li>
                                    <a href="#">Nữ<span><img src="{{ asset('public/frontend/img/icon/hot.png') }}" alt=""></span></a>
                                    <div class="mega-menu">
                                        <span>
                                            <a href="shop-left-sidebar.html" class="title">Category</a>
                                            <a href="#"><i class="fa fa-circle"></i>Men's Colletion</a>
                                            <a href="#"><i class="fa fa-circle"></i>Women's Colletion</a>
                                            <a href="#"><i class="fa fa-circle"></i>Kid's Colletion</a>
                                            <a href="#"><i class="fa fa-circle"></i>Bag's Colletion</a>
                                            <a href="#"><i class="fa fa-circle"></i>Shoes Colletion</a>
                                            <a href="#"><i class="fa fa-circle"></i>Accessories</a>
                                        </span>
                                        <span>
                                            <a href="shop-left-sidebar.html" class="title">Brands</a>
                                            <a href="#"><i class="fa fa-circle"></i>Zara</a>
                                            <a href="#"><i class="fa fa-circle"></i>Walmart</a>
                                            <a href="#"><i class="fa fa-circle"></i>Arong</a>
                                            <a href="#"><i class="fa fa-circle"></i>Rong</a>
                                            <a href="#"><i class="fa fa-circle"></i>Velloci</a>
                                            <a href="#"><i class="fa fa-circle"></i>Dolce &amp; Gabbana</a>
                                        </span>
                                        <span>
                                            <a href="shop-left-sidebar.html" class="title">Materials</a>
                                            <a href="#"><i class="fa fa-circle"></i>Cotton</a>
                                            <a href="#"><i class="fa fa-circle"></i>Cotton Blends</a>
                                            <a href="#"><i class="fa fa-circle"></i>Lilen</a>
                                            <a href="#"><i class="fa fa-circle"></i>Polister</a>
                                            <a href="#"><i class="fa fa-circle"></i>Polister Blends</a>
                                            <a href="#"><i class="fa fa-circle"></i>Jeans</a>
                                        </span>
                                    </div>
                                </li>
                                <li class="shortcode">
                                    <a href="#">Thương hiệu</a>
                                    <x-brand-header></x-brand-header>
                                </li>
                                <li class="dropdown">
                                    <a href="#">Blog</a>
                                </li>
                                <li><a href="{{ route('frontend.contact') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- Mobile Menu Area start -->
                <div class="mobile-menu-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="mobile-menu">
                                    <nav id="dropdown">
                                        <ul>
                                            <li><a href="{{ route('frontend') }}">Trang chủ</a></li>
                                            <li>
                                                <a href="#">Loại Thời Trang</a>
                                                <x-type-product-header-mobile></x-type-product-header-mobile>
                                            </li>
                                            <li>
                                                <a href="#">Quà tặng</a>
                                                <ul>
                                                    <li><a href="#">Dịp 8/3</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">Thương Hiệu</a>
                                                <x-brand-header-mobile></x-brand-header-mobile>
                                            </li>
                                            <li><a href="#">Blog</a></li>
                                            <li><a href="{{ route('frontend.contact') }}">Liên Hệ</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mobile Menu Area end -->
            </header>
            <!-- header end -->

            <!-- fixed image start -->
            <x-banner-top></x-banner-top>
            <!-- fixed image end -->


            <!-- start content -->
            @yield('content')
            <!-- end content -->


            <!-- start brand -->
            <x-slide-brand></x-slide-brand>
            <!-- end brand -->

            <!-- service area end -->
            <div class="service-area mb-10">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="single-service text-center">
                                <div class="single-service-content ptb-40">
                                    <div class="single-service-icon-wrapper">
                                        <div class="single-service-icon">
                                            <img src="{{ asset('public/frontend/img/icon/5.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="single-service-info">
                                        <h4 class="text-uppercase">vận chuyển</h4>
                                        <p>Miễn phí với tất cả sản phẩm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="single-service text-center">
                                <div class="single-service-content ptb-40">
                                    <div class="single-service-icon-wrapper">
                                        <div class="single-service-icon">
                                            <img src="{{ asset('public/frontend/img/icon/7.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="single-service-info">
                                        <h4 class="text-uppercase">Đặt hàng trực tuyến</h4>
                                        <p>www.shofixestore.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="single-service text-center">
                                <div class="single-service-content ptb-40">
                                    <div class="single-service-icon-wrapper">
                                        <div class="single-service-icon">
                                            <img src="{{ asset('public/frontend/img/icon/9.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="single-service-info">
                                        <h4 class="text-uppercase">hoàn tiền</h4>
                                        <p>một cách nhanh chóng</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 hidden-sm col-xs-12">
                            <div class="single-service text-center">
                                <div class="single-service-content ptb-40">
                                    <div class="single-service-icon-wrapper">
                                        <div class="single-service-icon">
                                            <img src="{{ asset('public/frontend/img/icon/10.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="single-service-info">
                                        <h4 class="text-uppercase">quà tặng</h4>
                                        <p>Phiếu quà tặng bất ngờ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- service area end -->
            <!-- touch area end -->
            <div class="touch-area ptb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="touch-left">
                                <div class="touch-logo mb-35">
                                    <a href="{{ asset('') }}"><img src="{{ asset('public/frontend/img/logo/2.png') }}" alt="shofixe"></a>
                                </div>
                                <p>Trang web mua sắm trực tuyến hằng đầu tại Việt Nam, thanh toán với nhiều phương thức khác nhau, nhân viên hỗ trợ nhiệt tình.</p>
                                <p>Giao hàng nhanh chóng, đổi trả tuyệt vời, hoàn toàn miễn phí vận chuyển với các đơn hàng từ 200k trở lên.</p>
                                <div class="social-icon">
                                    <ul>
                                        <li><a href="https://www.facebook.com/profile.php?id=100032359117436" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="touch-right">
                                <h2 class="text-uppercase">phản hồi về chúng tôi</h2>
                                <form id="contact-form" action="{{ route('frontend.fellback') }}" method="post">
                                    @csrf
                                    <input type="text" placeholder="Tên của bạn..." maxlength="42" name="name" autocomplete="off" required>
                                    <input type="email" placeholder="Địa chỉ email..." name="email" autocomplete="off" required>
                                    <textarea class="mtb-25" cols="30" rows="10" name="content" placeholder="Phản hồi của bạn là..." name="message" required></textarea>
                                    <div class="text-center"><button class="section-button" type="submit">Gửi</button></div>
                                </form>
                                <p class="form-message"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- touch area end -->
            <!-- footer start -->
            <footer class="footer-area">
                <div class="footer-middle-area ptb-60">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="footer-widget">
                                    <h5 style="font-family: Arial, Helvetica, sans-serif; font-weight: 700;">Liên Hệ</h5>
                                    <div class="single-footer-contact">
                                        <div class="footer-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="footer-contact-info">
                                            <p>Số 7 Đường Trần Phú, </p>
                                            <p>Phú Hòa, Thoại Sơn, An Giang</p>
                                        </div>
                                    </div>
                                    <div class="single-footer-contact">
                                        <div class="footer-icon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="footer-contact-info">
                                            <p>SĐT : <a href="tel:0333894499"> (033) 389 4499</a></p>
                                            <p>SĐT: (033) 276 6269</p>
                                        </div>
                                    </div>
                                    <div class="single-footer-contact">
                                        <div class="footer-icon">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                        <div class="footer-contact-info">
                                            <p>Email : <a href="mailto:devnguhoc@gmail.com">devnguhoc@gmail.com</a></p>
                                            <p>Web : <a href="{{ asset('') }}">{{ config('app.name') }}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="footer-widget">
                                    <h5 style="font-family: Arial, Helvetica, sans-serif; font-weight: 700;">Trang Web</h5>
                                    <ul>
                                        <li><a href="{{ asset('') }}"><i class="fa fa-circle"></i>Trang Chủ</a></li>
                                        <li><a href="{{ route('frontend.about_us') }}"><i class="fa fa-circle"></i>Về Chúng Tôi</a></li>
                                        <li><a href="blog.html"><i class="fa fa-circle"></i>Blog Của Chúng Tôi</a></li>
                                        <li><a href="#"><i class="fa fa-circle"></i>Trung Tâm Hỗ Trợ</a></li>
                                        <li><a href="{{ route('frontend.term') }}"><i class="fa fa-circle"></i>Điều Khoản Sử Dụng</a></li>
                                        <li><a href="{{ route('frontend.policy') }}"><i class="fa fa-circle"></i>Chính Sách Bảo Mật</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3 hidden-sm col-xs-12">
                                <div class="footer-widget">
                                    <h5 style="font-family: Arial, Helvetica, sans-serif; font-weight: 700;">Hỗ Trợ</h5>
                                    <ul>
                                        <li><a href="#"><i class="fa fa-circle"></i>Thông Tin Giao Hàng</a></li>
                                        <li><a href="#"><i class="fa fa-circle"></i>Theo Dõi Đơn Hàng</a></li>
                                        <li><a href="#"><i class="fa fa-circle"></i>Trả Sản Phẩm</a></li>
                                        <li><a href="#"><i class="fa fa-circle"></i>Thẻ Quà Tặng</a></li>
                                        <li><a href="#"><i class="fa fa-circle"></i>Giao Hàng Tận Nhà</a></li>
                                        <li><a href="#"><i class="fa fa-circle"></i>Hỗ Trợ Trực Tuyến</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-3 col-xs-12">
                                <div class="footer-widget">
                                    <h5 style="font-family: Arial, Helvetica, sans-serif; font-weight: 700;">Thông Tin</h5>
                                    <ul>
                                        <li><a href="#"><i class="fa fa-circle"></i>Phương Thức Thanh Toán</a></li>
                                        <li><a href="#"><i class="fa fa-circle"></i>Chuyển Hàng</a></li>
                                        <li><a href="#"><i class="fa fa-circle"></i>Thanh Toán</a></li>
                                        <li><a href="#"><i class="fa fa-circle"></i>Giảm Giá</a></li>
                                        <li><a href="#"><i class="fa fa-circle"></i>Sitemap</a></li>
                                        <li><a href="#"><i class="fa fa-circle"></i>Dịch Vụ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom-area ptb-25">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="copyright">
                                    <p>Copyright @ {{ date('Y') }} <span><a href="{{ route('frontend') }}">{{ config('app.name') }}</a></span>. All right reserved. </p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="footer-menu text-center">
                                    <nav>
                                        <ul>
                                            <li><a href="">Site Map</a></li>
                                            <li><a href="{{ route('frontend.contact') }}">Liên Hệ</a></li>
                                            <li class="hidden-md hidden-xs"><a href="#">Sản Phẩm</a></li>
                                            <li><a href="#">Bản Tin</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-md-4 hidden-sm">
                                <div class="payment text-right">
                                    <img src="{{ asset('public/frontend/img/payment/1.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- footer end -->
        </div>
    </div>

    <!-- QUICKVIEW PRODUCT -->
    <div id="quickview-wrapper">
        <div class="modal fade" id="MyProductModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        Xem Nhanh
                        <button id="my-btn-close" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body" id="data-product-return"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END QUICKVIEW PRODUCT -->


    <!-- my alert -->
    <div id="my-alert" class="alert hide">
        <span class="fas fa-bell"></span>
        <span id="my-message" class="msg">This is a warning alert!</span>
    </div>
    <!-- end my alert -->

    <div id="background-modal" class=""></div>

    <!-- jquery ============================================ -->
    <script src="{{ asset('public/frontend/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <!-- bootstrap JS ============================================ -->
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <!-- meanmenu JS ============================================ -->
    <script src="{{ asset('public/frontend/js/jquery.meanmenu.js') }}"></script>
    <!-- wow JS ============================================ -->
    <script src="{{ asset('public/frontend/js/wow.min.js') }}"></script>
    <!-- owl.carousel JS ============================================ -->
    <script src="{{ asset('public/frontend/js/owl.carousel.min.js') }}"></script>
    <!-- counterdown JS ============================================ -->
    <script src="{{ asset('public/frontend/js/jquery.countdown.min.js') }}"></script>
    <!-- Video Player JS ============================================ -->
    <script src="{{ asset('public/frontend/js/jquery.mb.YTPlayer.js') }}"></script>
    <!-- AJax Chimp JS ============================================ -->
    <script src="{{ asset('public/frontend/js/jquery.ajaxchimp.min.js') }}"></script>
    <!-- price slider JS ============================================ -->
    <script src="{{ asset('public/frontend/js/jquery-price-slider.js') }}"></script>
    <!-- elevator JS ============================================ -->
    <script src="{{ asset('public/frontend/js/jquery.elevateZoom-3.0.8.min.js') }}"></script>
    <!-- scrollUp JS ============================================ -->
    <script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
    <!-- plugins JS ============================================ -->
    <script src="{{ asset('public/frontend/js/plugins.js') }}"></script>
    <!-- Nevo Slider js ============================================ -->
    <script type="text/javascript" src="{{ asset('public/frontend/lib/custom-slider/js/jquery.nivo.slider.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/lib/custom-slider/home.js') }}"></script>
    <!-- textillate js ============================================ -->
    <script src="{{ asset('public/frontend/js/jquery.textillate.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.lettering.js') }}"></script>
    <!-- animated headline js ============================================ -->
    <script src="{{ asset('public/frontend/js/animate-heading.js') }}"></script>
    <!-- ajax js ============================================ -->
    <script src="{{ asset('public/frontend/js/ajax-mail.js') }}"></script>
    <!-- main JS ============================================ -->
    <script src="{{ asset('public/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{ asset('public/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('public/js/app.js') }}"></script>
    @yield('javascript')
</body>

</html>