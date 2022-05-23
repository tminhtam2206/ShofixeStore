@extends('layouts.frontend')
@section('title', 'Đăng Nhập')
@section('content')
<div class="contact-area pt-90">
                    <div class="container">
                        <div class="row">
                        <!-- contact us form start -->
                        <div class="row">
                            <div class="col-xs-12"></div>
                                <div class="contact-us-form">
                                    <div class="section-title text-center">
                                        <h4>ĐỂ LẠI LỜI NHẮN</h4>
                                    </div>
                                </div>    
                            </div>  
                            <div class="row">
                                <div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12 ">  
                                    <div class="contact-form">
                                        <form action="{{ route('frontend.contatct_post') }}" method="post">
                                            @csrf
                                            <div class="form-top">
                                                <div class="form-group col-xs-12">
                                                    <label>Họ tên<span class="required" title="required">*</span></label>
                                                    <input name="name" type="text" class="form-control" autocomplete="off" placeholder="Họ và tên..." required>
                                                </div>									
                                                <div class="form-group col-xs-12">
                                                    <label>Địa chỉ email<span class="required" title="required">*</span></label>
                                                    <input name="email" type="email" class="form-control" autocomplete="off" placeholder="Địa chỉ email..." required>
                                                </div>	
                                                <div class="form-group col-xs-12">
                                                    <label>Lời nhắn<span class="required" title="required">*</span></label>
                                                    <textarea name="content" class="form-control" placeholder="Lời nhắn của bạn..." maxlength="255" required></textarea>
                                                </div>												
                                            </div>
                                            <div class="submit-form form-group col-xs-12 submit-review text-center">
                                                <div class="clearfix"></div>
                                                <button class="section-button mt-20" type="submit"><span>GỬI</span></button>
                                            </div>
                                        </form>
                                        <p class="form-message-two"></p>
                                    </div>
                                   <!-- contact us form end -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <div class="contact-us-area">
                                        <!-- google-map-area start -->
                                        <div class="google-map-area mt-90">
                                            <!--  Map Section -->
                                            <div id="contacts" class="map-area">
                                                <div id="googleMap" style="width:100%;height:390px;">
                                                <iframe 
                                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.391162879151!2d105.30761411428398!3d10.310546970440276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310a0963d6a40281%3A0x27bcd31bd7d954f1!2zTmfhu41jIERp4buHdSBCZWF1dHk!5e0!3m2!1sen!2s!4v1617966918773!5m2!1sen!2s" 
                                                    style="border:0; width: 100%; height: 100%;" allowfullscreen="" loading="lazy">
                                                </iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="google-address">
                                        <ul>
                                            <li>
                                                <img src="{{ asset('public/frontend/img/icon/11.png') }}">Số 7, Đường Trần Phú, Phú Hòa, Thoại Sơn, An Giang.
                                            </li>
                                            <li>
                                                <img src="{{ asset('public/frontend/img/icon/12.png') }}">Số điện thoại: (+84) 333 894 499 <br>Số điện thoại : (+84) 365 319 298
                                            </li>
                                            <li>
                                                <img src="{{ asset('public/frontend/img/icon/13.png') }}">
                                                Email : <span><a href="mailto:tminhtam170599@gmail.com"> tminhtam170599@gmail.com</a></span> <br>
                                                Web: <a href="{{ route('frontend') }}"> www.shofixestore.com</a>
                                            </li>
                                        </ul>
                                    </div>    
                                </div>     
                            </div>   
                        <!-- google-map-area end -->
                        </div>
                    </div>
                </div>
@endsection