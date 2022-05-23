@extends('layouts.backend')
@section('title', 'Đơn Hàng')
@section('content')
<div class="page-inner">
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('backend') }}"><i class="breadcrumb-icon fas fa-home mr-2"></i>Bảng Điều Khiển</a>
                </li>
                <li class="breadcrumb-item">
                    <span></i>Đơn Hàng</span>
                </li>
            </ol>
        </nav>
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto">DANH SÁCH ĐƠN HÀNG</h1>
            <div class="btn-toolbar" style="width: 250px;">
                <form method="get" action="{{ route('backend.order.export_excel') }}" style="width: 100%;">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <select class="form-control" name="type_export">
                                <option value="day">Hôm Nay</option>
                                <option value="month">Theo Tháng</option>
                                <option value="year">Theo Năm</option>
                                <option value="all">Tất Cả</option>
                            </select>
                        </div>
                        <div class="col-md-6"><button type="submit" class="btn btn-warning"><i class="oi oi-data-transfer-download"></i> Xuất Excel</button></div>
                    </div>
                </form>
            </div>
        </div>
    </header>
    <div class="page-section">
        <div class="card card-fluid">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="Order-Table" class="table table-success table-striped">
                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width:25px">ID</th>
                                <th>NGƯỜI ĐẶT</th>
                                <th>NGƯỜI NHẬN</th>
                                <th>SĐT</th>
                                <th style="width: 10px;">ĐỊA CHỈ</th>
                                <th style="width: 10px;">GHI CHÚ</th>
                                <th>Tổng Tiền</th>
                                <th style="width: 100px;">TRẠNG THÁI</th>
                                <th style="width:85px;">HÀNH ĐỘNG</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $value)
                            <tr id="tr-{{ $value->id }}">
                                <td class="align-middle">#{{ $value->id }}</td>
                                <td class="align-middle">{{ $value->User->name }}</td>
                                <td class="align-middle">{{ $value->name }}</td>
                                <td class="align-middle">{{ $value->phone }}</td>
                                <td class="align-middle"><input class="order-address-temp form-control" type="text" value="{{ $value->address }}" readonly></td>
                                <td class="align-middle"><input class="order-note-temp form-control" type="text" value="{{ $value->note }}" readonly></td>
                                <td class="align-middle"><span class="badge badge-pill badge-info">{{ number_format($value->total) }}<sup>đ</sup></span></td>
                                <td class="align-middle text-danger">
                                    <select id="user-order-{{ $value->id }}" class="form-control my-status" data-order="{{ $value->id }}" @if($value->status == 'Hủy đơn') disabled @endif>
                                        <option value="Đang duyệt" @if($value->status == 'Đang duyệt') selected @endif>Đang duyệt</option>
                                        <option value="Đã duyệt" @if($value->status == 'Đã duyệt') selected @endif>Đã duyệt</option>
                                        <option value="Đã nhận" @if($value->status == 'Đã nhận') selected @endif>Đã nhận</option>
                                        <option value="Hủy đơn" @if($value->status == 'Hủy đơn') selected @endif>Hủy đơn</option>
                                    </select>
                                </td>

                                <td class="align-middle text-center">
                                    <a href="{{ route('backend.order.show_detail', ['id' => $value->id]) }}" class="btn btn-sm btn-icon btn-success mr-3" title="Xem chi tiết đơn hàng">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('backend.order.print_pdf', ['order_id' => $value->id]) }}" class="btn btn-sm btn-icon btn-primary" title="In đơn hàng">
                                        <i class="fas fa-print"></i>
                                    </a>
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

<!-- Modal Address -->
<div class="modal fade" id="OrderAddress" tabindex="-1" aria-labelledby="LableOrderAddress" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="width: 100%; border-bottom: 1px solid;">
                <h5 style="width: 100%;" class="modal-title text-center" id="LableOrderAddress">ĐỊA CHỈ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="Order-Detail-Address-Content">
                    This is content...
                </p>
            </div>
        </div>
    </div>
</div>


<!-- Modal Note -->
<div class="modal fade" id="OrderNote" tabindex="-1" aria-labelledby="LableOrderNote" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="width: 100%; border-bottom: 1px solid;">
                <h5 style="width: 100%;" class="modal-title text-center" id="LableOrderNote">GHI CHÚ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="Order-Detail-Note-Content">
                    This is content...
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script>
    $('.my-status').change(function() {
        var order_id = $(this).attr("data-order");
        var status_tmp = $(this).val();

        if (status_tmp == 'Hủy đơn') {
            if (confirm('Bạn có chắc là muốn hủy đơn hàng #' + order_id)) {
                $.ajax({
                    url: "{{ route('backend.order.change_status') }}",
                    data: {
                        id: order_id,
                        status: status_tmp
                    },
                    type: 'get',
                    success: function() {
                        $('#my-msg').text('Đã cập nhật trạng thái cho đơn hàng #' + order_id);
                        $('.toast').toast('show');
                        $('#user-order-'+order_id).attr('disabled', 'disabled');
                        $('#tr-'+order_id).remove();
                    }
                });
            }
        } else {
            $.ajax({
                url: "{{ route('backend.order.change_status') }}",
                data: {
                    id: order_id,
                    status: status_tmp
                },
                type: 'get',
                success: function() {
                    $('#my-msg').text('Đã cập nhật trạng thái cho đơn hàng #' + order_id);
                    $('.toast').toast('show');
                }
            });
        }
    });

    $('.order-address-temp').dblclick(function() {
        let content = $(this).val();
        $('#Order-Detail-Address-Content').text(content);
        $('#OrderAddress').modal('show');
    });

    $('.order-note-temp').dblclick(function() {
        let content = $(this).val();
        $('#Order-Detail-Note-Content').text(content);
        $('#OrderNote').modal('show');
    });

    $(document).ready(function() {
        $('#Order-Table').DataTable({
            language: {
                url: "{{ asset('public/backend/js/vi.json') }}"
            },
            "bSort": false
        });
    });
</script>
@endsection