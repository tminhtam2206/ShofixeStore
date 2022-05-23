@extends('layouts.frontend_manager')
@section('title', 'Bảng Điều Khiển')
@section('content')
<div class="page-inner">
    <header class="page-title-bar">
        <div class="d-flex flex-column flex-md-row">
            <p class="lead">
                <span class="font-weight-bold text-uppercase">Xin chào, {{ Auth::user()->name }}.</span><span class="d-block text-muted text-uppercase">Đây là những gì đang xảy ra với cửa hàng của bạn ngày hôm nay.</span>
            </p>
            <div class="ml-auto">
                <input type="text" class="form-control" data-toggle="flatpickr" value="{{ date('Y-m-d') }}" data-enable-time="true" data-date-format="Y-m-d">
            </div>
        </div>
    </header>

    <div class="page-section">
        <div class="section-block">
            <div class="metric-row">
                <div class="col-lg-9">
                    <div class="metric-row metric-flush">
                        <div class="col">
                            <a href="#" class="metric metric-bordered align-items-center">
                                <h2 class="metric-label">ĐƠN HÀNG ĐÃ MUA</h2>
                                <p class="metric-value h3">
                                    <sub>
                                        <i class="fas fa-clipboard-list"></i>
                                    </sub>
                                    <span class="value"> {{ $my_order }}</span>
                                </p>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#" class="metric metric-bordered align-items-center">
                                <h2 class="metric-label">SẢN PHẨM ĐÃ MUA</h2>
                                <p class="metric-value h3">
                                    <sub><i class="fab fa-product-hunt"></i></sub><span class="value"> {{ $my_product_buy }}</span>
                                </p>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#" class="metric metric-bordered align-items-center">
                                <h2 class="metric-label">TIỀN KHUYẾN MÃI</h2>
                                <p class="metric-value h3">
                                    <sub>
                                        <i class="fas fa-coins"></i>
                                    </sub>
                                    <span class="value"> {{ number_format(Auth::user()->coin) }}<sup>đ</sup></span>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <a href="#" class="metric metric-bordered">
                        <div class="metric-badge text-center">
                            <span class="badge badge-lg badge-success"><span class="oi oi-media-record pulse mr-1"></span> ĐƠN HÀNG CHỜ DUYỆT</span>
                        </div>
                        <p class="metric-value h3 text-center">
                            <sub><i class="oi oi-timer"></i></sub><span class="value"> {{ $oder_wait_approval }}</span>
                        </p>
                    </a>
                </div>
            </div>
        </div>

        <div class="card-deck-xl">
            <div class="card card-fluid pb-3">
                <div class="card-header bg-success text-light">HOẠT ĐỘNG GẦN ĐÂY</div>
                <div class="lits-group list-group-flush">
                    @foreach($load_record as $value)
                    <div class="list-group-item">
                        <div class="list-group-item-figure">
                            <div class="has-badge">
                                <a href="#" class="tile tile-md bg-purple"><i class="fas fa-calendar-alt"></i></a>
                                <a href="#" class="user-avatar user-avatar-xs" style="border: none;"></a>
                            </div>
                        </div>
                        <div class="list-group-item-body">
                            <h5 class="card-title">
                                <a href="#">{{ $value->action }}</a>
                            </h5>
                            <p class="card-subtitle text-muted mb-1">{{ $value->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card card-fluid">
                <div class="card-header bg-success text-light">ĐƠN HÀNG GẦN ĐÂY</div>
                <div class="card-body">
                    <table id="Order-Table" class="table table-success table-striped">
                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width:25px">ID</th>
                                <th>NGƯỜI NHẬN</th>
                                <th>SĐT</th>
                                <th>Tổng Tiền</th>
                                <th style="width: 100px;">TRẠNG THÁI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $value)
                            <tr id="tr-{{ $value->id }}">
                                <td class="align-middle">#{{ $value->id }}</td>
                                <td class="align-middle">{{ $value->name }}</td>
                                <td class="align-middle">{{ $value->phone }}</td>
                                <td class="align-middle"><span class="badge badge-pill badge-info">{{ number_format($value->total) }}<sup>đ</sup></span></td>
                                <td class="align-middle text-danger">
                                    <span class="badge badge-pill badge-warning">
                                        @if($value->status == 0)
                                        Đang duyệt
                                        @elseif($value->status == 1)
                                        Đã duyệt
                                        @elseif($value->status == 2)
                                        Đã nhận
                                        @else
                                        Hủy đơn
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('frontend.order') }}" class="card-footer-item">Xem tất cả <i class="fa fa-fw fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection