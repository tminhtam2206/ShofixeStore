@extends('layouts.backend')
@section('title', 'Sản Phẩm')
@section('content')
<input id="token" type="text" value="{{ csrf_token() }}" hidden>
<div class="page-inner">
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('backend') }}"><i class="breadcrumb-icon fas fa-home mr-2"></i>Bảng Điều Khiển</a>
                </li>
                <li class="breadcrumb-item">
                    <span></i>Sản Phẩm</span>
                </li>
            </ol>
        </nav>
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto">DANH SÁCH SẢN PHẨM</h1>
            <div class="btn-toolbar">
                <a href="{{ route('backend.product.add') }}" class="btn btn-primary"><i class="far fa-plus"></i><span class="ml-1">Thêm Mới</span></a>
            </div>
        </div>
    </header>
    <div class="page-section">
        <div class="card card-fluid">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tableProduct" class="table table-success table-striped">
                        <thead>
                            <tr class="bg-dark text-white">
                                <th class="text-center" style="width:25px">#</th>
                                <th>ẢNH</th>
                                <th>SẢN PHẨM</th>
                                <th>DANH MỤC</th>
                                <th>THƯƠNG HIỆU</th>
                                <th>NHẬP</th>
                                <th>TỒN</th>
                                <th>ĐƠN GIÁ</th>
                                <th>GIÁ BÁN</th>
                                <th class="text-center">GIẢM GIÁ</th>
                                <th class="text-center" style="width:50px;"> DUYỆT</th>
                                <th class="text-center" style="width:50px;"> TRẠNG THÁI</th>
                                <th class="text-center" style="width:85px;">HÀNH ĐỘNG</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $value)
                            <tr id="tr-{{ $value->id }}">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="align-middle"><img src="{{ firstProductImage($value->image) }}" width="50"></td>
                                <td class="align-middle">{{ $value->name }}</td>
                                <td class="align-middle">{{ $value->Category->name }}</td>
                                <td class="align-middle">{{ $value->Brand->name }}</td>
                                <td class="align-middle">{{ $value->import }}</td>
                                <td class="align-middle">{{ $value->exist }}</td>
                                <td class="align-middle text-danger">{{ number_format($value->unit_price) }}<sup>đ</sup> </td>
                                <td class="align-middle text-danger">{{ number_format($value->price) }}<sup>đ</sup> </td>
                                <td class="align-middle"><span class="badge badge-pill badge-success">{{ $value->discount }}%</span></td>
                                <td class="align-middle text-center">
                                    <span id="span-view-danh-muc-{{ $value->id }}" class="btn btn-sm btn-secondary" title="@if($value->approval == 'YES') Đã được duyệt @else Chưa được duyệt @endif" onclick="editDuyet('{{ $value->name }}', '{{ $value->id }}', '{{ $value->approval }}')">
                                        <i id="view-danh-muc-{{ $value->id }}" class="fas @if($value->approval == 'YES') fa-check @else fa-ban @endif"></i>
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="btn btn-sm btn-secondary" onclick="editStatus('{{ $value->name }}','{{ $value->id }}', '{{ $value->status }}')">
                                        <i id="status-danh-muc-{{ $value->id }}" class="fas @if($value->status == 'hide') fa-eye-slash @else fa-eye @endif"></i>
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('backend.product.edit', ['id' => $value->id]) }}" class="btn btn-sm btn-icon btn-primary mr-2">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <span class="btn btn-sm btn-icon btn-danger" onclick="Delete('{{ $value->name }}','{{ $value->id }}')">
                                        <i class="far fa-trash"></i>
                                    </span>
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
@endsection

@section('javascript')
<script>
    var token = $('#token').val();

    function editDuyet(name, type_id, approval) {
        var your_choose = $('#view-danh-muc-' + type_id).attr('class');

        if (your_choose == 'fas  fa-ban' || your_choose == 'fas fa-ban' || your_choose == 'fas  fa-ban ') {
            $.confirm({
                title: '<i class="fas fa-exclamation-triangle"></i> Thông Báo',
                content: 'Bạn có muốn <b>duyệt</b> sản phẩm [<b>' + name + '</b>] không?',
                type: 'purple',
                buttons: {
                    deleteUser: {
                        text: '<i class="fas fa-check"></i> Duyệt',
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: "{{ route('backend.product.edit_approval') }}",
                                data: {
                                    id: type_id,
                                    approval: approval,
                                    _token: token
                                },
                                type: 'post',
                                success: function() {
                                    $('#view-danh-muc-' + type_id).removeClass('fas fa-ban');
                                    $('#view-danh-muc-' + type_id).addClass('fas fa-check');
                                    $('#span-view-danh-muc-' + type_id).attr('title', 'Sản phẩm ' + name + ' đã được duyệt!');
                                    $.alert('Đã duyệt sản phẩm [<b>' + name + '</b>]');
                                }
                            });
                        }
                    },
                    cancelAction: {
                        text: 'Đóng',
                        btnClass: 'btn-blue'
                    }
                }
            });
        } else {
            $.confirm({
                title: '<i class="fas fa-exclamation-triangle"></i> Thông Báo',
                content: 'Bạn có muốn <b>thu hồi</b> sản phẩm [<b>' + name + '</b>] không?',
                type: 'purple',
                buttons: {
                    deleteUser: {
                        text: '<i class="fas fa-ban"></i> Thu Hồi',
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: "{{ route('backend.product.edit_approval') }}",
                                data: {
                                    id: type_id,
                                    approval: approval,
                                    _token: token
                                },
                                type: 'post',
                                success: function() {
                                    $('#view-danh-muc-' + type_id).removeClass('fas fa-check');
                                    $('#view-danh-muc-' + type_id).addClass('fas fa-ban');
                                    $('#span-view-danh-muc-' + type_id).attr('title', 'Sản phẩm ' + name + ' chưa được duyệt!');
                                    $.alert('Đã thu hồi sản phẩm [<b>' + name + '</b>]');
                                }
                            });
                        }
                    },
                    cancelAction: {
                        text: 'Đóng',
                        btnClass: 'btn-blue'
                    }
                }
            });
        }
    }

    function editStatus(name, id_type, status) {
        var your_choose = $('#status-danh-muc-' + id_type).attr('class');

        if (your_choose == 'fas  fa-eye-slash ' || your_choose == 'fas fa-eye-slash' || your_choose == 'fas  fa-eye-slash') {
            $.confirm({
                title: '<i class="fas fa-exclamation-triangle"></i> Thông Báo',
                content: 'Bạn có muốn <b>hiển thị</b> sản phẩm [<b>' + name + '</b>] không?',
                type: 'purple',
                buttons: {
                    deleteUser: {
                        text: '<i class="fas fa-eye"></i> Hiển Thị',
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: "{{ route('backend.product.edit_status') }}",
                                data: {
                                    id: id_type,
                                    status: status,
                                    _token: token
                                },
                                type: 'post',
                                success: function() {
                                    $('#status-danh-muc-' + id_type).removeClass('fas fa-eye-slash');
                                    $('#status-danh-muc-' + id_type).addClass('fas fa-eye');
                                    $.alert('Đã hiển thị sản phẩm [<b>' + name + '</b>]');
                                }
                            });
                        }
                    },
                    cancelAction: {
                        text: 'Đóng',
                        btnClass: 'btn-blue'
                    }
                }
            });
        } else {
            $.confirm({
                title: '<i class="fas fa-exclamation-triangle"></i> Thông Báo',
                content: 'Bạn có muốn <b>ẩn</b> sản phẩm [<b>' + name + '</b>] không?',
                type: 'purple',
                buttons: {
                    deleteUser: {
                        text: '<i class="fas fa-eye-slash"></i> Ẩn',
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: "{{ route('backend.product.edit_status') }}",
                                data: {
                                    id: id_type,
                                    status: status,
                                    _token: token
                                },
                                type: 'post',
                                success: function() {
                                    $('#status-danh-muc-' + id_type).removeClass('fas fa-eye');
                                    $('#status-danh-muc-' + id_type).addClass('fas fa-eye-slash');
                                    $.alert('Đã ẩn sản phẩm [<b>' + name + '</b>]');
                                }
                            });
                        }
                    },
                    cancelAction: {
                        text: 'Đóng',
                        btnClass: 'btn-blue'
                    }
                }
            });
        }
    }

    function Delete(name, id_type) {
        $.confirm({
            title: '<i class="fas fa-exclamation-triangle"></i> Cảnh Báo',
            content: 'Bạn có muốn <b>xóa</b> sản phẩm [<b>' + name + '</b>] không?' +
                '<br><small>Việc này sẽ làm <b>mất tất cả</b> bình luận, đơn hàng,.... của sản phẩm náy</small>',
            type: 'red',
            buttons: {
                deleteUser: {
                    text: '<i class="fas fa-trash"></i> Xóa Vĩnh Viễn',
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: "{{ route('backend.product.delete') }}",
                            data: {
                                id: id_type,
                                _token: token
                            },
                            type: 'post',
                            success: function(data_return) {
                                if (data_return != 1) {
                                    $.confirm({
                                        title: '<i class="fas fa-exclamation-triangle"></i> Thông Báo',
                                        content: 'Bạn không thể xóa vì [' + name + '] <b>đã được sử dụng</b>.',
                                        type: 'red',
                                        buttons: {
                                            cancelAction: {
                                                text: 'Đóng',
                                                btnClass: 'btn-blue'
                                            }
                                        }
                                    });
                                } else {
                                    $('#tr-' + id_type).remove();
                                }
                            }
                        });
                    }
                },
                cancelAction: {
                    text: 'Đóng',
                    btnClass: 'btn-blue'
                }
            }
        });
    }

    $(document).ready(function() {
        $('#tableProduct').DataTable({
            language: {
                url: "{{ asset('public/backend/js/vi.json') }}"
            },
            "bSort": false
        });
    });
</script>
@endsection