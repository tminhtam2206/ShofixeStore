@extends('layouts.frontend')
@section('title', 'Thanh Toán')
@section('content')
<!-- checkout start -->
<div class="checkout-area-start pt-90">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-tab-menu section-tab-menu pb-50 text-center">
                    <ul>
                        <li class="text-uppercase"><a href="{{ route('frontend.cart') }}">GIỎ HÀNG</a></li>
                        <li class="text-uppercase active"><a href="{{ route('frontend.check_out') }}">THANH TOÁN</a></li>
                        <li class="text-uppercase"><a href="#">HOÀN TẤT</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <form action="{{ route('frontend.post_check_out') }}" method="post" onsubmit="return check_form()">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="billing-detail">
                        <div class="section-title">
                            <h4 class="text-uppercase mb-35" style="font-weight: 700;">CHI TIẾT THANH TOÁN 
                            <small style="float: right; text-decoration: underline;">
                                <a class="text-primary" href="@if(Auth::user()->role == 'user'){{ route('frontend.my_account.setting') }}@else{{ route('backend.my_account.setting') }}@endif">Đổi Địa Chỉ Mạc Định</a>
                            </small>
                        </h4>
                        </div>

                        <div class="form-group">
                            <label for="email">Địa chỉ email (*)</label>
                            <input type="email" class="form-control my-custom-input" id="email" value="{{ Auth::user()->email }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Tên người nhận (*)</label>
                            <input type="text" class="form-control my-custom-input" id="name" value="@if($user_detail != null){{ $user_detail->name }}@else{{ Auth::user()->name }}@endif" name="name" maxlength="42" autocomplete="off" placeholder="Tên người nhận..." required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại (*)</label>
                            <input type="text" class="form-control my-custom-input" id="phone" name="phone" maxlength="11" value="@if($user_detail != null){{ $user_detail->phone }}@endif" autocomplete="off" placeholder="Số điện thoại..." required>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ nhận hàng (*)</label>
                            <input type="text" class="form-control my-custom-input" id="address" name="address" value="@if($user_detail != null){{ $user_detail->address }}@endif" maxlength="255" autocomplete="off" placeholder="Địa chỉ nhận hàng..." required>
                        </div>
                        <div class="form-group">
                            <label for="note">Ghi chú</label>
                            <textarea class="form-control" name="note" id="note" cols="30" rows="10" maxlength="255"></textarea>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="total-cart">
                        <div class="section-title">
                            <h4 class="text-uppercase mb-48">TỔNG GIỎ HÀNG</h4>
                        </div>
                        <div class="your-order">
                            <div class="order-table">
                                <ul>
                                    <li>
                                        <h5 class="focus">SẢN PHẨM <span>TỔNG</span></h5>
                                        @foreach(Cart::content() as $value)
                                        <p>{{ $value->name }} <span> x {{ $value->qty }} [màu: {{ $value->options->color }}| kích thước: {{ $value->options->size }}]</span><span>{{ number_format($value->price * $value->qty) }}</span></p>
                                        @endforeach
                                    </li>
                                    <li>
                                        <h5>Tổng tiền <span>{{ Cart::subTotal() }}<sup>đ</sup></span></h5>
                                    </li>
                                    <li>
                                        <h5>Phí vận chuyển <span>Miễn phí</span></h5>
                                    </li>
                                    <li class="order-total-purple">
                                        <h5 class="focus">TỔNG THANH TOÁN <span>{{ Cart::total() }}<sup>đ</sup></span></h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="section-title mt-50 mb-25">
                            <h4 class="text-uppercase">HÌNH THỨC THANH TOÁN</h4>
                        </div>
                        <div class="your-order">
                            <div class="order-table">
                                <ul>
                                    <li>
                                        <label class="checkbox-title">
                                            <input id="transfer" value="bank" name="cod" type="radio">COD

                                        </label>
                                        <p id="transfer-info">Trả tiền khi nhận được sản phẩm.</p>
                                    </li>
                                    <li>
                                        <label class="checkbox-title">
                                            <input id="payment" value="check" name="chuyen" type="radio">CHUYỂN KHOẢN
                                        </label>
                                        <p id="payment-info">Chuyển tiền đến số tài khoản của chúng tôi. Sacombank: 0124555555555</p>
                                    </li>
                                    <li>
                                        <label class="checkbox-title">
                                            <input id="paypal" value="paypal" name="payment" type="radio">PAYPAL
                                        </label>
                                        <p id="paypal-info">Thanh toán qua ngân hàng số Paypal.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @if(Cart::count() > 0)
                        <button class="section-button btn" style="border: 0;" type="submit">ĐẶT HÀNG NGAY</button>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- checkout end -->
@endsection

@section('javascript')
<script>
    function check_form() {
        var Phone = $('#phone').val();

        if (!$.isNumeric(Phone)) {
            my_custom_alert('Số điện thoại không được chứa [chữ cái]!');
            return false;
        } else {
            if (Phone.length < 10) {
                my_custom_alert('Số điện thoại không được dưới [10 ký tự]!');
                return false;
            }
        }

        return true;
    }
</script>
@endsection