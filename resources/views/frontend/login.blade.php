@extends('layouts.frontend')
@section('title', 'Đăng Nhập')
@section('content')
<div class="contact-area pt-90">
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-xs-12"></div>
                <div class="contact-us-form">
                    <div class="section-title text-center">
                        <h4>ĐĂNG NHẬP VỚI TÀI KHOẢN HIỆN CÓ</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12 ">
                    <div class="contact-form">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-top">
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
                            </div>
                            <div class="submit-form form-group col-xs-12 submit-review text-center">
                                <div class="clearfix"></div>
                                <button class="btn btn-warning mt-20" type="submit"><span>Đăng Nhập</span></button>
                            </div>
                        </form>
                        <p class="form-message-two"></p>
                        <div class="clearfix"></div>
                        <div class="mt-20">
                            <span>Bạn chưa có tài khoản? </span><a href="{{ route('frontend.register') }}">Đăng Ký</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection