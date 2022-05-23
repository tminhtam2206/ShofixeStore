@extends('layouts.frontend_manager')
@section('title', 'Đơn Hàng')
@section('content')
<div class="page-inner">
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('frontend.user_manager') }}"><i class="breadcrumb-icon fas fa-home mr-2"></i>Bảng Điều Khiển</a>
                </li>
                <li class="breadcrumb-item">
                    <span></i>Đơn Hàng</span>
                </li>
            </ol>
        </nav>
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

                                <td class="align-middle text-center">
                                    <a href="{{ route('frontend.order.detail', ['id' => $value->id]) }}" class="btn btn-sm btn-icon btn-primary mr-3" title="Xem chi tiết đơn hàng">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-icon btn-danger" title="Hủy đơn hàng">
                                        <i class="fas fa-times"></i>
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