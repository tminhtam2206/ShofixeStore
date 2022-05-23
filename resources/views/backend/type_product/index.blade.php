@extends('layouts.backend')
@section('title', 'Loại Sản Phẩm')
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
                    <span></i>Loại Sản Phẩm</span>
                </li>
            </ol>
        </nav>
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto">LOẠI SẢN PHẨM</h1>
            <div class="btn-toolbar">
                <button type="button" class="btn btn-primary" id="btn-add-model"><i class="far fa-plus"></i><span class="ml-1">Thêm Mới</span></button>
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
                                <th>LOẠI SẢN PHẨM</th>
                                <th>KHỞI TẠO</th>
                                <th>CẬP NHẬT</th>
                                <th class="text-center" style="width:85px;">HÀNH ĐỘNG</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($type_product as $value)
                            <tr id="tr-{{ $value->id }}">
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $value->name }}</td>
                                <td class="align-middle">{{ $value->created_at->diffForHumans() }}</td>
                                <td class="align-middle">{{ $value->updated_at->diffForHumans() }}</td>
                                <td class="align-middle text-center">
                                    <button class="btn btn-sm btn-icon btn-primary mr-2" onclick="editName('{{ $value->name }}','{{ $value->id }}')">
                                        <i class="fa fa-pencil-alt"></i>
                                        <span class="sr-only">Edit</span>
                                    </button>
                                    <span class="btn btn-sm btn-icon btn-danger" onclick="DeleteCaterory('{{ $value->name }}','{{ $value->id }}')">
                                        <i class="far fa-trash"></i>
                                        <span class="sr-only">Remove</span>
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

<form action="{{ route('backend.type_product.add') }}" method="post" onsubmit="return checkAdd()">
    @csrf
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addModalLabel" style="width:100%;">THÊM LOẠI SẢN PHẨM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tenloai" style="width: 100%;">
                            Tên loại sản phẩm
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                            <span id="max-length" class="text-danger float-right"></span>
                        </label>
                        <input type="text" class="form-control" id="tenloai" name="name" autocomplete="off" value="" maxlength="42" required />
                        <div class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i><strong id="tenloai-error"></strong></div>
                    </div>
                </div>
                <div class="text-center pb-3">
                    <button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Lưu Loại Sản Phẩm</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="{{ route('backend.type_product.edit') }}" method="post" onsubmit="return checkAdd()">
    @csrf
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
        <input type="text" id="id-input-edit" name="id" hidden>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editModalLabel" style="width: 100%;">CHỈNH SỬA LOẠI SẢN PHẨM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-tenloai" style="width:100%;">
                            Tên loại sản phẩm
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                            <span id="edit-max-length" class="text-danger float-right"></span>
                        </label>
                        <input type="text" class="form-control" id="edit-tenloai" name="name" autocomplete="off" value="" maxlength="42" required />
                        <div id="edit-status-caterory" class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i><strong id="edit-tenloai-error"></strong></div>
                    </div>
                </div>
                <div class="text-center pb-3">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Cập Nhật Loại Sản Phẩm</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('javascript')
<script>
    var check_add = false;
    var token = $('#token').val();

    $(document).ready(function() {
        $('#btn-add-model').click(function() {
            $('#addModal').modal('show');
        });

        $('#tenloai').keyup(function() {
            var max = 42;
            var curr = max - $(this).val().length;
            var key = $(this).val();

            if ($(this).val() != '') {
                $.ajax({
                    url: "{{ route('backend.type_product.check') }}",
                    data: {
                        name: key,
                        _token: token
                    },
                    type: 'post',
                    success: function(data_return) {
                        if (data_return == '0') {
                            $('#tenloai').removeClass('is-invalid');
                            $('#tenloai').addClass('is-valid');
                            check_add = true;
                        } else {
                            $('#tenloai').removeClass('is-valid');
                            $('#tenloai').addClass('is-invalid');
                            $('#tenloai-error').text('Loại sản phẩm [' + key + '] đã tồn tại!');
                            check_add = false;
                        }
                    }
                });
                $('#max-length').text('[Còn lại: ' + curr + ' ký tự]');
            } else {
                $('#max-length').text('');
            }
        });

        $('#edit-tenloai').keyup(function() {
            var max = 42;
            var curr = max - $(this).val().length;
            var key = $(this).val();

            if ($(this).val() != '') {
                $.ajax({
                    url: "{{ route('backend.type_product.check') }}",
                    data: {
                        name: key,
                        _token: token
                    },
                    type: 'post',
                    success: function(data_return) {
                        if (data_return == '0') {
                            $('#edit-tenloai').removeClass('is-invalid');
                            $('#edit-tenloai').addClass('is-valid');
                            $('#edit-status-caterory').hide();
                            check_add = true;
                        } else {
                            $('#edit-tenloai').removeClass('is-valid');
                            $('#edit-tenloai').addClass('is-invalid');
                            $('#edit-status-caterory').show();
                            $('#edit-tenloai-error').text('Loại sản phẩm [' + key + '] đã tồn tại!');
                            check_add = false;
                        }
                    }
                });
                $('#edit-max-length').text('[Còn lại: ' + curr + ' ký tự]');
            } else {
                $('#edit-max-length').text('');
            }
        });
    });

    function checkAdd() {
        if (!check_add)
            return false;
        return true;
    }

    function DeleteCaterory(name, id_type) {
        $.confirm({
            title: '<i class="fas fa-exclamation-triangle"></i> Cảnh Báo',
            content: 'Bạn có muốn <b>xóa</b> loại sản phẩm [<b>' + name + '</b>] không?' +
                '<br><small>Việc này sẽ làm <b>mất tất cả</b> sản phẩm, bình luận, đơn hàng,....</small>',
            type: 'red',
            buttons: {
                deleteUser: {
                    text: '<i class="fas fa-trash"></i> Xóa Vĩnh Viễn',
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: "{{ route('backend.type_product.delete') }}",
                            data: {
                                id: id_type,
                                _token: token
                            },
                            type: 'post',
                            success: function(data_return) {
                                if (data_return != 1) {
                                    $.confirm({
                                        title: '<i class="fas fa-exclamation-triangle"></i> Thông Báo',
                                        content: 'Bạn không thể xóa vì ['+name+'] <b>đã được sử dụng</b>.',
                                        type: 'red',
                                        buttons: {
                                            cancelAction: {
                                                text: 'Đóng',
                                                btnClass: 'btn-blue'
                                            }
                                        }
                                    });
                                }
                                else{
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

    function editName(name, id_type) {
        $('#edit-tenloai').val(name);
        $('#id-input-edit').val(id_type);
        $('#editModal').modal('show');
    }
</script>
@endsection