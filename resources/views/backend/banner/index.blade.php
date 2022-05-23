@extends('layouts.backend')
@section('title', 'Ảnh Bìa')
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
                    <span></i>Ảnh Bìa</span>
                </li>
            </ol>
        </nav>
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto text-uppercase">Ảnh Bìa</h1>
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
                                <th>THƯƠNG HIỆU</th>
                                <th>LOGO</th>
                                <th>CẬP NHẬT</th>
                                <th style="width:50px;">SỬA</th>
                                <th style="width:50px;">XÓA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banner as $value)
                            <tr id="tr-{{ $value->id }}">
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $value->name }}</td>
                                <td class="align-middle"><img src="@if($value->logo !== null) {{ getLogoBrand($value->logo) }} @endif" width="50"></td>
                                <td class="align-middle">{{ $value->created_at->diffForHumans() }}</td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-icon btn-primary" onclick="editName('{{ $value->name }}','{{ $value->id }}')">
                                        <i class="fa fa-pencil-alt"></i>
                                        <span class="sr-only">Edit</span>
                                    </button>
                                </td>
                                <td class="align-middle">
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

<form action="{{ route('backend.brand.add') }}" method="post" enctype="multipart/form-data" onsubmit="return checkAdd()">
    @csrf
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addModalLabel" style="width: 100%;">THÊM Thương Hiệu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ten-danh-muc" style="width: 100%;">
                            Tên Thương Hiệu
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                            <span id="max-length" class="text-danger float-right"></span>
                        </label>
                        <input type="text" class="form-control" id="ten-danh-muc" name="name" autocomplete="off" value="" maxlength="42" required />
                        <div id="status-caterory" class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i><strong id="ten-danh-muc-error"></strong></div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input id="logo" class="custom-file-input" type="file" accept=".png, .jpg, .webp" name="logo" required>
                            <label class="custom-file-label" for="logo">Chọn logo</label>
                        </div>
                    </div>
                </div>
                <div class="text-center pb-3">
                    <button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Lưu Thương Hiệu</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="{{ route('backend.brand.edit') }}" method="post" enctype="multipart/form-data" onsubmit="return checkEdit()">
    @csrf
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
        <input type="text" name="id" id="inputEditHide" hidden>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editModalLabel" style="width: 100%;">CHỈNH SỬA Thương Hiệu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-ten-danh-muc" style="width: 100%;">
                            Tên danh mục
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                            <span id="edit-max-length" class="text-danger float-right"></span>
                        </label>
                        <input type="text" class="form-control" id="edit-ten-danh-muc" name="name" autocomplete="off" value="" maxlength="42" required />
                        <div id="edit-status-caterory" class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i><strong id="edit-ten-danh-muc-error"></strong></div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input id="logo" class="custom-file-input" type="file" accept=".png, .jpg, .webp" name="logo">
                            <label class="custom-file-label" for="logo">Chọn logo</label>
                        </div>
                    </div>
                </div>
                <div class="text-center pb-3">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Cập Nhật</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('javascript')
<script>
    var token = $('#token').val();
    var check_add = false;
    var check_edit = true;

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
                    url: "{{ route('backend.brand.check') }}",
                    data: {
                        name: key,
                        _token: token
                    },
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
                            $('#ten-danh-muc-error').text('Tên Thương Hiệu [' + key + '] đã được sử dụng!');
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
            check_edit = true;

            if ($(this).val() != '') {
                $.ajax({
                    url: "{{ route('backend.brand.check') }}",
                    data: {
                        name: key,
                        _token: token
                    },
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
                            $('#edit-ten-danh-muc-error').text('Tên Thương Hiệu [' + key + '] đã được sử dụng!');
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
            content: 'Bạn có muốn <b>xóa</b> thương hiệu [<b>' + name + '</b>] không?',
            type: 'red',
            buttons: {
                deleteUser: {
                    text: '<i class="fas fa-trash"></i> Xóa Vĩnh Viễn',
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: "{{ route('backend.brand.delete') }}",
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

    function editName(name, id_type) {
        $('#edit-ten-danh-muc').val(name);
        $('#inputEditHide').val(id_type);
        $('#editModal').modal('show');
    }
</script>
@endsection