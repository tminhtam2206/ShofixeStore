@extends('layouts.backend')
@section('title', 'Danh Mục Sản Phẩm')
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
                    <span></i>Danh Mục Sản Phẩm</span>
                </li>
            </ol>
        </nav>
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto">DANH SÁCH DANH MỤC</h1>
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
                                <th>DANH MỤC</th>
                                <th>CẬP NHẬT</th>
                                <th class="text-center" style="width:85px;">HÀNH ĐỘNG</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category as $value)
                            <tr id="tr-{{ $value->id }}">
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $value->TypeProduct->name }}</td>
                                <td class="align-middle">{{ $value->name }}</td>
                                <td class="align-middle">{{ $value->created_at->diffForHumans() }}</time></td>
                                <td class="align-middle text-center">
                                    <button class="btn btn-sm btn-icon btn-primary mr-2" onclick="editName('{{ $value->name }}','{{ $value->id }}', '{{ $value->TypeProduct->id }}')">
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

<form action="{{ route('backend.category.add') }}" method="post" onsubmit="return checkAdd()">
    @csrf
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addModalLabel" style="width:100%;">THÊM DANH MỤC SẢN PHẨM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="loaisanpham_id">
                            <b><i class="fas fa-user-shield"></i> Loại sản phẩm</b>
                            <abbr title="Bắt buộc chọn">(*)</abbr>
                        </label>
                        <select class="custom-select" id="loaisanpham_id" name="type_product_id" required>
                            <option value="">-- Chọn --</option>
                            @foreach($type_product as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ten-danh-muc" style="width: 100%;">
                            Tên danh mục
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                            <span id="max-length" class="text-danger float-right"></span>
                        </label>
                        <input type="text" class="form-control" id="ten-danh-muc" name="name" autocomplete="off" value="" maxlength="42" required />
                        <div id="status-caterory" class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i><strong id="ten-danh-muc-error"></strong></div>
                    </div>
                </div>
                <div class="text-center pb-3">
                    <button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Lưu Danh Mục</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="{{ route('backend.category.edit') }}" method="post" onsubmit="return checkEdit()">
    @csrf
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
        <input type="text" id="id-input-edit" name="id" hidden>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editModalLabel" style="width: 100%;">CHỈNH SỬA DANH MỤC SẢN PHẨM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-loaisanpham_id">
                            <b><i class="fas fa-user-shield"></i> Loại sản phẩm</b>
                            <abbr title="Bắt buộc chọn">(*)</abbr>
                        </label>
                        <select class="custom-select" id="edit-loaisanpham_id" name="type_product_id" required>
                            <option value="">-- Chọn --</option>
                            @foreach($type_product as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-ten-danh-muc" style="width:100%;">
                            Tên danh mục
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                            <span id="edit-max-length" class="text-danger float-right"></span>
                        </label>
                        <input type="text" class="form-control" id="edit-ten-danh-muc" autocomplete="off" name="name" value="" maxlength="42" required />
                        <div id="edit-status-caterory" class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i><strong id="edit-ten-danh-muc-error"></strong></div>
                    </div>
                </div>
                <div class="text-center pb-3">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Cập Nhật Danh Mục</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('javascript')
<script>
    var check_add = false;
    var check_edit = true;
    var token = $('#token').val();

    $(document).ready(function() {
        $('#btn-add-model').click(function() {
            $('#addModal').modal('show');
        });

        $('#ten-danh-muc').keyup(function() {
            var max = 42;
            var curr = max - $(this).val().length;
            var key = $(this).val();

            if ($(this).val() != '') {
                $.ajax({
                    url: "{{ route('backend.category.check') }}",
                    data: {name:key, _token:token},
                    type: 'post',
                    success: function(data_return) {
                        if (data_return == '0') {
                            $('#ten-danh-muc').removeClass('is-invalid');
                            $('#ten-danh-muc').addClass('is-valid');
                            $('#status-caterory').hide();
                            check_add = true;
                        } else {
                            $('#ten-danh-muc').removeClass('is-valid');
                            $('#ten-danh-muc').addClass('is-invalid');
                            $('#status-caterory').show();
                            $('#ten-danh-muc-error').text('Tên danh mục [' + key + '] đã tồn tại!');
                            check_add = false;
                        }
                    }
                });
                $('#max-length').text('[Còn lại: ' + curr + ' ký tự]');
            } else {
                $('#max-length').text('');
            }
        });

        $('#edit-ten-danh-muc').keyup(function() {
            var max = 42;
            var curr = max - $(this).val().length;
            var key = $(this).val();

            if ($(this).val() != '') {
                $.ajax({
                    url: "{{ route('backend.category.check') }}",
                    data: {name:key, _token:token},
                    type: 'post',
                    success: function(data_return) {
                        if (data_return == '0') {
                            $('#edit-ten-danh-muc').removeClass('is-invalid');
                            $('#edit-ten-danh-muc').addClass('is-valid');
                            $('#edit-status-caterory').hide();
                            check_edit = true;
                        } else {
                            $('#edit-ten-danh-muc').removeClass('is-valid');
                            $('#edit-ten-danh-muc').addClass('is-invalid');
                            $('#edit-status-caterory').show();
                            $('#edit-ten-danh-muc-error').text('Tên danh mục [' + key + '] đã được sử dụng!');
                            check_edit = false;
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

    function checkEdit() {
        if (!check_edit)
            return false;
        return true;
    }

    function DeleteCaterory(name, id_type) {
        $.confirm({
            title: '<i class="fas fa-exclamation-triangle"></i> Cảnh Báo',
            content: 'Bạn có muốn <b>xóa</b> danh mục [<b>' + name + '</b>] không?',
            type: 'red',
            buttons: {
                deleteUser: {
                    text: '<i class="fas fa-trash"></i> Xóa Vĩnh Viễn',
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: "{{ route('backend.category.delete') }}",
                            data: {id:id_type, _token:token},
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

    function editName(name, id_type, loai_id){
        $('#edit-ten-danh-muc').val(name);
        $('#id-input-edit').val(id_type);
        $("#edit-loaisanpham_id option[value='" + loai_id + "']").attr("selected", "selected");
        $('#editModal').modal('show');
    }
</script>
@endsection