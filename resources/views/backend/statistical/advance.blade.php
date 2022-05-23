@extends('layouts.backend')
@section('title', 'Thống Kê Nâng Cao')
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
                    <span></i>Nâng Cao</span>
                </li>
            </ol>
        </nav>
        <div class="d-md-flex align-items-md-start">
            <div class="page-title mr-sm-auto" style="width: 600px;">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row" style="width: 148px;">
                            <label for="inputPassword" class="col-sm-3" style="font-size: 16px; line-height: 39px;">Từ: </label>
                            <div class="col-sm-9">
                                <input id="date-from" type="text" class="form-control" data-toggle="flatpickr" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row" style="width: 160px;">
                            <label for="inputPassword" class="col-sm-3" style="font-size: 16px; line-height: 39px;">Đến: </label>
                            <div class="col-sm-9">
                                <input id="date-to" type="text" class="form-control" data-toggle="flatpickr" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button id="btn-filter-statistical" class="btn btn-primary" style="margin-top: -10px;"><i class="fas fa-filter"></i> Lọc</button>
                    </div>
                </div>
            </div>
            <div class="btn-toolbar">
                <button id="btn-export-data" class="btn btn-warning"><i class="oi oi-data-transfer-download"></i> Xuất Excel</button>
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
                        <div id="count-order" style="width: 100%; font-weight: bold;" class="text-center text-light" style="text-shadow: 1px 1px #000;">0</div>
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
                        <div id="count-product" style="width: 100%; font-weight: bold;" class="text-center text-light" style="text-shadow: 1px 1px #000;">0</div>
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
                        <div style="width: 100%; font-weight: bold;" class="text-center text-light" style="text-shadow: 1px 1px #000;"><span id="total_price">0</span><sup>đ</sup></div>
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
                        <div style="width: 100%; font-weight: bold; text-shadow: 1px 1px #000;" class="text-center text-light"><span id="total-profix">0</span><sup>đ</sup></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="page-section">
        <div class="card card-fluid">
            <div class="card-body py-0 px-0 mb-0">
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
                        <tbody id="get-data-table">
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
    $('#btn-filter-statistical').click(function() {
        let from_val = $('#date-from').val();
        let to_val = $('#date-to').val();

        if (from_val != '' && to_val != '') {
            $.ajax({
                url: "{{ route('backend.statistical.advance.filter') }}",
                dataType: 'json',
                data: {
                    from: from_val,
                    to: to_val
                },
                type: 'get',
                success: function(data_return) {
                    $('#count-order').text(data_return.total_order);
                    $('#count-product').text(data_return.total_product);
                    $('#total_price').text(data_return.total_price);
                    $('#total-profix').text(data_return.total_profix);

                    $('#filterTable').DataTable().destroy();

                    $('#filterTable').find('tbody').html(data_return.order);
                    $('#filterTable').DataTable({
                        language: {
                            url: "{{ asset('public/backend/js/vi.json') }}"
                        },
                        "bSort": false

                    });
                    $('#filterTable').DataTable().draw();
                }
            });
        }
    });

    $('#btn-export-data').click(function(){
        let from_val = $('#date-from').val();
        let to_val = $('#date-to').val();

        $(location).attr('href', 'http://localhost/ShofixeStore/admin/statistical/advance/filter/export/'+from_val+'/'+to_val);
    });
</script>
@endsection