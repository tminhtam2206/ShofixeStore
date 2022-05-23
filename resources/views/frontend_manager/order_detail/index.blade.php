@extends('layouts.backend')
@section('title', 'Chi Tiết Đơn Hàng')
@section('content')
<div class="page-inner">
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('frontend.user_manager') }}"><i class="breadcrumb-icon fas fa-home mr-2"></i>Bảng Điều Khiển</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('frontend.order') }}">Đơn Hàng</a>
                </li>
                <li class="breadcrumb-item">
                    <span></i>Chi Tiết</span>
                </li>
            </ol>
        </nav>
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title text-center" style="width: 100%; text-shadow: 2px 1px;">CHI TIẾT ĐƠN HÀNG #{{ $id }}</h1>
        </div>
    </header>
    <div class="page-section">
        <div class="card card-fluid">
            <div class="card-body p-0 m-0">
                <div class="table-responsive p-0 m-0">
                    <table class="table table-success table-striped p-0 m-0">
                        <thead>
                            <tr class="bg-dark text-white">
                                <th>STT</th>
                                <th>SẢN PHẨM</th>
                                <th>SỐ LƯỢNG</th>
                                <th>GÍA BÁN</th>
                                <th>GIẢM GIÁ</th>
                                <th>KÍCH THƯỚC</th>
                                <th>MÀU SẮC</th>
                                <th>TỔNG TIỀN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($order_detail as $value)
                            <tr>
                                <td class="align-middle">{{ $loop->index+1 }}</td>
                                <td class="align-middle">{{ $value->Product->name }}</td>
                                <td class="align-middle">{{ $value->amount }}</td>
                                <td class="align-middle">{{ number_format($value->price) }}</td>
                                <td class="align-middle"><span class="badge badge-pill badge-info">{{ $value->discount }}%</span></td>
                                <td class="align-middle">{{ $value->size }}</td>
                                <td class="align-middle">{{ $value->color }}</td>
                                <td class="align-middle text-danger">{{ number_format($value->price * $value->amount) }}<sup>đ</sup></td>
                                @php $total += ($value->price * $value->amount); @endphp
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="pt-2 px-2" style="width: 100%;">
                    <h5 class="float-left">TỔNG THANH TOÁN:</h5>
                    <h5 class="float-right" style="color: #e83012;">{{ number_format($total) }}<sup>đ</sup></h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection