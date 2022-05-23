@extends('layouts.backend')
@section('title', 'Thống Kê Cơ Bản')
@section('content')
<div class="page-inner">
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('backend') }}"><i class="breadcrumb-icon fas fa-home mr-2"></i>Bảng Điều Khiển</a>
                </li>
                <li class="breadcrumb-item">
                    <span></i>Thống Kê</span>
                </li>
                <li class="breadcrumb-item">
                    <span></i>Cơ Bản</span>
                </li>
            </ol>
        </nav>
        <div class="d-md-flex align-items-md-start">
            <div class="page-title mr-sm-auto">
                <form style="width: 350px;">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <select id="form-sort-date" class="form-control" name="type_sort">
                                <option value="{{ route('backend.statistical.basic_today') }}" {{ request()->is('admin/statistical/basic/today') ? 'selected' : '' }}>Hôm Nay</option>
                                <option value="{{ route('backend.statistical.basic_month') }}" {{ request()->is('admin/statistical/basic/month') ? 'selected' : '' }}>Tháng Này</option>
                                <option value="{{ route('backend.statistical.basic_year') }}" {{ request()->is('admin/statistical/basic/year') ? 'selected' : '' }}>Năm Nay</option>
                                <option value="{{ route('backend.statistical.basic_all') }}" {{ request()->is('admin/statistical/basic/all') ? 'selected' : '' }}>Tất Cả</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="btn-toolbar" style="width: 250px;">
                <form method="get" action="{{ route('backend.order.export_excel') }}" style="width: 100%;">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <select class="form-control" name="type_export">
                                <option value="day">Hôm Nay</option>
                                <option value="month">Tháng Này</option>
                                <option value="year">Năm Nay</option>
                                <option value="all">Tất Cả</option>
                            </select>
                        </div>
                        <div class="col-md-6"><button type="submit" class="btn btn-warning"><i class="oi oi-data-transfer-download"></i> Xuất Excel</button></div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="card bg-info">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fas fa-file-invoice-dollar fa-3x"></i>
                            </div>
                            <div class="col-sm-10">
                                <h2 class="card-title text-center text-light" style="text-shadow: 1px 1px #000;">ĐƠN HÀNG</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-2 py-2">
                        <div style="width: 100%; font-weight: bold;" class="text-center text-light" style="text-shadow: 1px 1px #000;">{{ count($order) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-success">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fas fa-cart-arrow-down fa-3x"></i>
                            </div>
                            <div class="col-sm-10">
                                <h2 class="card-title text-center text-light" style="text-shadow: 1px 1px #000;">SẢN PHẨM</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-2 py-2">
                        <div style="width: 100%; font-weight: bold;" class="text-center text-light" style="text-shadow: 1px 1px #000;">{{ $total_product }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fas fa-money-bill-wave fa-3x"></i>
                            </div>
                            <div class="col-sm-10">
                                <h2 class="card-title text-center text-light" style="text-shadow: 1px 1px #000;">TỔNG TIỀN</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-2 py-2">
                        <div style="width: 100%; font-weight: bold;" class="text-center text-light" style="text-shadow: 1px 1px #000;">{{ number_format($total_price) }}<sup>đ</sup></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-warning">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fas fa-coins fa-3x"></i>
                            </div>
                            <div class="col-sm-10">
                                <h2 class="card-title text-center text-light" style="text-shadow: 1px 1px #000;">LỢI NHUẬN</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-2 py-2">
                        <div style="width: 100%; font-weight: bold; text-shadow: 1px 1px #000;" class="text-center text-light">{{ number_format($total_profix) }}<sup>đ</sup></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="page-section">
        <div class="card card-fluid">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="filterTable" class="table table-success table-striped">
                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width:25px">#</th>
                                <th>NGƯỜI ĐẶT</th>
                                <th>NGÀY ĐẶT</th>
                                <th class="text-center">TRẠNG THÁI</th>
                                <th class="text-center">TỔNG TIỀN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $value)
                            <tr>
                                <td class="align-middle">{{ $loop->index+1 }}</td>
                                <td class="align-middle">{{ $value->User->name }}</td>
                                <td class="align-middle">{{ date('d-m-Y H:m:i', strtotime($value->created_at)) }}</td>
                                <td class="text-center"><span class="badge badge-pill badge-success">
                                        @if($value->status == 0)
                                        Đang duyệt
                                        @elseif($value->status == 1)
                                        Đã duyệt
                                        @elseif($value->status == 2)
                                        Đã nhận
                                        @else
                                        Hủy đơn
                                        @endif
                                    </span></td>
                                <td class="text-center"><span class="badge badge-pill badge-info">{{ number_format($value->total) }}<sup>đ</sup></span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    $('#form-sort-date').change(function(){
        let link_val = $(this).val();
        $(location).attr('href', link_val);
    });
</script>
@endsection