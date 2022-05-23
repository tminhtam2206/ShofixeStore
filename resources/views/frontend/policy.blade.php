@extends('layouts.frontend')
@section('title', 'Chính Sách Bảo Mật')
@section('content')
<div class="checkout-area-start pt-90">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: #03a9f4;
            color: #FFFFFF;
            text-shadow: 0px 0px 1px #000; 
            font-weight: 700; 
            font-family: 'Times New Roman', Times, serif;
            font-size: 21px;
            "><i class="fas fa-handshake"></i> CHÍNH SÁCH BẢO MẬT @if($policy != null)<span style="float: right;"><i class="fas fa-calendar-alt"></i> {{ date('d-m-Y', strtotime($policy->updated_at)) }} bởi <i class="fas fa-user-shield"></i> {{ $policy->user_post }}</span>@endif</div>

            <div class="panel-body" style="
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"; 
            color: black !important;
            font-size: 18px;">
            @if($policy != null) {!! $policy->content !!} @endif
            </div>
        </div>
    </div>
</div>
@endsection