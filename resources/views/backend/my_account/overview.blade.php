@extends('backend.my_account.profile')
@section('title', 'Hồ Sơ Cá Nhân')
@section('child-content')
<div class="page-inner">
    <div class="page-section">
        <div class="section-block">
            <div class="metric-row">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card-metric" style="background-color: #846565;">
                        <div class="metric">
                            <p class="metric-value h3">
                                <sub><i class="fas fa-clipboard-list"></i></sub><span class="value  text-light">{{ $my_order }}</span>
                            </p>
                            <h2 class="metric-label text-light">Đơn Hàng</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card-metric" style="background-color: #846565;">
                        <div class="metric">
                            <p class="metric-value h3">
                                <sub><i class="fab fa-product-hunt"></i></sub><span class="value text-light">{{ $my_product_buy }}</span>
                            </p>
                            <h2 class="metric-label text-light">Sản Phẩm</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card-metric" style="background-color: #846565;">
                        <div class="metric">
                            <p class="metric-value h3">
                                <sub><i class="fas fa-heart"></i></sub><span class="value text-light">{{ $favourite }}</span>
                            </p>
                            <h2 class="metric-label text-light">Yêu Thích</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card-metric" style="background-color: #846565;">
                        <div class="metric">
                            <p class="metric-value h3">
                                <sub><i class="fas fa-comment"></i></sub><span class="value text-light">{{ $num_racting }}</span>
                            </p>
                            <h2 class="metric-label text-light">Đánh Giá</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-fluid">
                    <div class="card-header pt-2 py-0 bg-success" style="width: 100%;">
                        <h5 class="text-center text-light"><i class="fas fa-history"></i> ĐƠN HÀNG GẦN ĐÂY</h5>
                    </div>
                    <div class="card-body py-0 px-0 my-0">
                        <table class="table table-success table-striped">
                            <thead>
                                <tr>
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
                                        @if($value->status == 0)
                                        <span class="btn btn-warning">Đang duyệt</span>
                                        @elseif($value->status == 1)
                                        <span class="btn btn-warning">Đã duyệt</span>
                                        @elseif($value->status == 2)
                                        <span class="btn btn-warning">Đã nhận</span>
                                        @else
                                        <span class="btn btn-warning">Đã hủy</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection