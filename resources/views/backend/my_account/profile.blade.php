@extends('layouts.backend')
@section('title', 'Hồ Sơ Cá Nhân')

@section('content')
<header class="page-cover">
    <div class="text-center">
        <a href="{{ route('backend.my_account.profile') }}" class="user-avatar user-avatar-xl">
            <img id="focus-change-avatar-2" src="{{ asset('storage/app/public/avatar').'/'.Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
        </a>
        <h2 class="h4 mt-2 mb-0 text-capitalize">{{ Auth::user()->fullname }}</h2>
        <div class="my-1">
            <i class="fa fa-star text-yellow"></i>
            <i class="fa fa-star text-yellow"></i>
            <i class="fa fa-star text-yellow"></i>
            <i class="fa fa-star text-yellow"></i>
            <i class="fa fa-star text-yellow"></i>
        </div>
        <p class="text-muted text-capitalize">#@if(Auth::user()->role == 'user') Khách hàng @elseif(Auth::user()->role == 'staff') Nhân viên @else Quản trị viên @endif</p>
        <p id="focus-introduce">{{ Auth::user()->introduce }}</p>
    </div>
    <div class="cover-controls cover-controls-bottom">
        <a href="#" class="btn btn-light">2,159 Theo dõi</a>
        <a href="#" class="btn btn-light">136 Đăng ký</a>
    </div>
</header>
<nav class="page-navs">
    <div class="nav-scroller">
        <div class="nav nav-center nav-tabs">
            <a class="nav-link {{ (request()->is('admin/my-account/profile')) ? 'active' : '' }}" href="{{ route('backend.my_account.profile') }}">TỔNG QUAN</a>
            <a class="nav-link {{ (request()->is('admin/my-account/record')) ? 'active' : '' }}" href="{{ route('backend.my_account.record') }}"> NHẬT KÝ HOẠT ĐỘNG</a>
            <a class="nav-link" href="#">Ví Điện Tử</a>
            <a class="nav-link {{ (request()->is('admin/my-account/setting')) ? 'active' : '' }}" href="{{ route('backend.my_account.setting') }}">THIẾT LẬP</a>
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