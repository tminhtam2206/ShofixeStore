@extends('layouts.frontend')
@section('title', 'Giỏ Hàng')
@section('content')
<!-- cart start -->
<style>
    .my-font-header{
        font-family: Arial, Helvetica, sans-serif !important; 
        font-weight: 700 !important;
    }

    .new-font{
        font-family: Arial, Helvetica, sans-serif !important; 
    }
</style>
<div class="cart-area-start mt-90">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="cart-tab-menu section-tab-menu pb-50 text-center">
                    <ul>
                        <li class="text-uppercase active"><a href="{{ route('frontend.cart') }}">Giỏ Hàng</a></li>
                        <li class="text-uppercase"><a href="{{ route('frontend.check_out') }}">Thanh Toán</a></li>
                        <li class="text-uppercase"><a href="#">Hoàn Tất</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <div class="cart-table table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th class="p-name my-font-header">Tên Sản Phẩm</th>
                                <th class="p-amount my-font-header">Đơn Giá</th>
                                <th class="p-quantity my-font-header">Số Lượng</th>
                                <th class="p-quantity my-font-header">Kích Thước</th>
                                <th class="p-quantity my-font-header">Màu Sắc</th>
                                <th class="p-total my-font-header">Tổng Tiền</th>
                                <th class="my-font-header"></th>
                            </tr>
                        </thead>
                        <tbody class="pt-30">
                            <!-- start loop cart -->
                            @if(Cart::count())
                            @foreach(Cart::content() as $value)
                            <tr id="tr-{{ $value->rowId }}">
                                <td class="p-name text-left">
                                    <div class="cart-img">
                                        <a href="#"><img src="{{ $value->options->image }}" style="width: 126px; height: 135px;"></a>
                                    </div>
                                    <a href="#">{{ $value->name }}</a>
                                    <p>Kích thước: <span id="pick-size-{{ $value->rowId }}" style="font-weight: 700;">{{ $value->options->size }}</span></p>
                                    <p class="c-p-size">Màu: <span id="pick-color-{{ $value->rowId }}" style="font-weight: 700;">{{ $value->options->color }}</span></p>
                                </td>
                                <td class="p-amount"><span class="amount">{{ number_format($value->price) }}<sup>đ</sup></span></td>

                                <td class="p-quantity">
                                    <span class="badge" style="cursor: pointer;" onclick="cart_down('{{ $value->rowId }}')"><i class="fas fa-minus"></i></span>
                                    <input id="qty-{{ $value->rowId }}" type="text" value="{{ $value->qty }}" style="height: 35px" disabled>
                                    <span class="badge" style="cursor: pointer;" onclick="cart_up('{{ $value->rowId }}')"><i class="fas fa-plus"></i></span>
                                </td>

                                <td class="p-quantity size">
                                    <select id="size-{{ $value->rowId }}" class="form-control" style="width: 82px; height: 35px" onchange="change_size('{{ $value->rowId }}')">
                                        <option value="">--chọn--</option>
                                        @foreach($value->options->product_size as $value_size)
                                        <option value="{{ $value_size->size }}" @if($value_size->size == $value->options->size) selected @endif>{{ $value_size->size }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="p-quantity color">
                                    <select id="color-{{ $value->rowId }}" class="form-control" style="width: 95px; height: 35px" onchange="change_color('{{ $value->rowId }}')">
                                        <option value="">--chọn--</option>
                                        @foreach($value->options->product_color as $value_color)
                                        <option value="{{ $value_color->color }}" @if($value_color->color == $value->options->color) selected @endif>{{ $value_color->color }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td id="price-{{ $value->rowId }}" class="p-total">{{ number_format($value->price * $value->qty) }}<sup>đ</sup></td>
                                <td><button class="btn" onclick="delete_cart('{{ $value->rowId }}')"><i class="fa fa-trash"></i></button></td>
                            </tr>
                            @endforeach
                            @endif
                            <!-- end loop cart -->
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 pt-50">
                <div class="cart-coupn-leftside">
                    <div class="section-title">
                        <h4 class="text-uppercase pb-15">Khhu vực vận chuyển</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="shipping-info">
                                <select name="country">
                                    <option>Tỉnh Thành</option>
                                    <option>Bangladesh</option>
                                    <option>USA</option>
                                    <option>India</option>
                                    <option>UK</option>
                                    <option>Australia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="shipping-info">
                                <select name="state">
                                    <option>Quận Huyện</option>
                                    <option>Dhaka</option>
                                    <option>New York</option>
                                    <option>Torento</option>
                                    <option>Tokeyo</option>
                                    <option>Jakarta</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="shipping-info">
                                <select name="zip">
                                    <option>Mã code khu vực</option>
                                    <option>008</option>
                                    <option>001</option>
                                    <option>007</option>
                                    <option>002</option>
                                    <option>009</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="shipping-info">
                                <button>Xác Nhận</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="section-title">
                                <h4 class="text-uppercase pb-15 pt-10">mã giảm giá</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="cpn-code">
                                <input type="text" placeholder="Code giảm giá">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="shipping-info">
                                <button>Áp Dụng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="cart-coupon-rightside pt-50">
                    <div class="section-title">
                        <h4 class="text-uppercase pb-15 my-font-header">TỔNG TIỀN GIỎ HÀNG</h4>
                    </div>
                    <div class="amount-table table-responsive">
                        <table>
                            <tbody>
                                <tr class="s-total">
                                    <td>TỔNG TIỀN SẢN PHẨM <span id="tongtien-chua-tru-thue">{{ Cart::subTotal() }}<sup>đ</sup></span></td>
                                </tr>
                                <tr class="s-total">
                                    <td>THUẾ VAT (10%) <span>{{ Cart::tax() }}<sup>đ</sup></span></td>
                                </tr>
                                <tr class="g-total">
                                    <td class="my-font-header">TỔNG THANH TOÁN<span id="tong-thanh-toan" class="grand">{{ Cart::total() }}<sup>đ</sup></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if(Cart::count() > 0)
                    <div class="check-update pull-right">
                        <a href="{{ route('frontend.cart.delete_all') }}" class="mt-25 mr-25 section-button" onclick="return confirm('Bạn có chắc là muốn xóa toàn bộ giỏ hàng?')" disabled><i class="fas fa-trash"></i> xóa giỏ hàng</a>
                        <a href="{{ route('frontend.check_out') }}" class="checkout mt-25 section-button">Thanh Toán</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart end -->
@endsection