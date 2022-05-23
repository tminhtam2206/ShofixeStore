@extends('layouts.frontend')
@section('title', 'Điều Khoản Sử Dụng')
@section('content')
<!-- checkout start -->
<div class="checkout-area-start pt-90">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: #03a9f4;
            color: #FFFFFF;
            text-shadow: 0px 0px 1px #000; 
            font-weight: 700; 
            font-family: 'Times New Roman', Times, serif;
            font-size: 21px;
            "><i class="fas fa-gavel"></i> ĐIỀU KHOẢN SỬ DỤNG  @if($term != null)<span style="float: right;"><i class="fas fa-user-shield"></i> {{ date('d-m-Y', strtotime($term->updated_at)) }} bởi <i class="fas fa-user-shield"></i> {{ $term->user_post }}</span>@endif</div>
            
            <div class="panel-body" style="
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"; 
            color: black !important;
            font-size: 18px;">
            @if($term != null) {!! $term->content !!} @endif
            </div>
        </div>
    </div>
</div>
<!-- checkout end -->
@endsection