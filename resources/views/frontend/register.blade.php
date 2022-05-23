@extends('layouts.frontend')
@section('title', 'Đăng Ký')
@section('content')
<div class="contact-area pt-90">
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-xs-12"></div>
                <div class="contact-us-form">
                    <div class="section-title text-center">
                        <h4>ĐĂNG KÝ TÀI KHOẢN MIỄN PHÍ</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12 ">
                    <div class="contact-form">
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-top">
                                <div class="form-group col-xs-12">
                                    <label>Họ và tên<span class="required" title="required">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="Họ và tên">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Địa chỉ email<span class="required" title="required">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Địa chỉ email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Mật khẩu<span class="required" title="required">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Mật khẩu">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Nhập lại mật khẩu<span class="required" title="required">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" required placeholder="Nhập lại mật khẩu">
                                </div>
                                <div class="form-group form-check col-xs-12">
                                    <input type="checkbox" class="form-check-input" id="access" required>
                                    <label class="form-check-label" for="access">Tôi đồng ý với <a href="{{ route('frontend.term') }}">Điều Khoản</a> & <a href="{{ route('frontend.policy') }}" target="_blank">Chính Sách</a></label>
                                </div>
                            </div>
                            <div class="submit-form form-group col-xs-12 submit-review text-center">
                                <div class="clearfix"></div>
                                <button class="btn btn-warning mt-20" type="submit"><span>Đăng Ký</span></button>
                            </div>
                        </form>
                        <p class="form-message-two"></p>
                        <div class="clearfix"></div>
                        <div class="mt-20">
                            <span>Bạn đã có tài khoản? </span><a href="{{ route('frontend.register') }}">Đăng Nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection