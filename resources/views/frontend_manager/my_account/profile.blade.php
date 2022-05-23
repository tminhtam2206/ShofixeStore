@extends('layouts.frontend_manager')
@section('title', 'Hồ Sơ Cá Nhân')
@section('content')
<header class="page-cover">
    <div class="text-center">
        <a href="{{ route('backend.my_account.profile') }}" class="user-avatar user-avatar-xl">
            <img id="focus-change-avatar-2" src="{{ asset('storage/app/public/avatar').'/'.Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
        </a>
        <h2 class="h4 mt-2 mb-0 text-capitalize">{{ Auth::user()->fullname }}</h2>
        <div class="my-1">
            <i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="far fa-star text-yellow"></i>
        </div>
        <p class="text-muted">#@if(Auth::user()->role == 'user') Khách hàng @elseif(Auth::user()->role == 'staff') Nhân viên @else Quản trị viên @endif</p>
        <p id="focus-introduce">{{ Auth::user()->introduce }}</p>
    </div>
    <div class="cover-controls cover-controls-bottom">
        <a href="#" class="btn btn-light">2,159 Người theo dõi</a>
    </div>
</header>
<nav class="page-navs">
    <div class="nav-scroller">
        <div class="nav nav-center nav-tabs">
            <a class="nav-link {{ (request()->is('tai-khoan/ho-so')) ? 'active' : '' }}" href="{{ route('frontend.my_account.profile') }}">TỔNG QUAN</a>
            <a class="nav-link {{ (request()->is('tai-khoan/nhat-ky-hoat-dong')) ? 'active' : '' }}" href="{{ route('frontend.my_account.record') }}"> NHẬT KÝ HOẠT ĐỘNG</a>
            <a class="nav-link" href="#">Ví Điện Tử</a>
            <a class="nav-link {{ (request()->is('tai-khoan/thiet-lap')) ? 'active' : '' }}" href="{{ route('frontend.my_account.setting') }}">THIẾT LẬP</a>
        </div>
    </div>
</nav>
<div class="page-inner">
    <!-- start pages child -->
    @yield('child-content')
    <!-- end pages child -->
</div>
@endsection

@section('javascript')

@endsection