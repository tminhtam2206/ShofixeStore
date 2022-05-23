@extends('layouts.backend')
@section('title', 'Danh Sách Tài Khoản')
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
                    <span></i>Tài Khoản</span>
                </li>
                <li class="breadcrumb-item">
                    <span></i>{{ request()->is('admin/user/active') ? 'Hoạt Động' : '' }} {{ request()->is('admin/user/lock') ? 'Bị Khóa' : '' }} {{ request()->is('admin/user/all') ? 'Tất Cả' : '' }}</span>
                </li>
            </ol>
        </nav>
        <!-- <button type="button" class="btn btn-success btn-floated"><span class="fa fa-plus"></span></button> -->
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto text-uppercase">TÀI KHOẢN {{ request()->is('admin/user/active') ? 'Hoạt Động' : '' }} {{ request()->is('admin/user/lock') ? 'Bị Khóa' : '' }} {{ request()->is('admin/user/all') ? 'Tất Cả' : '' }}</h1>
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
                                <th style="width:150px;">HỌ VÀ TÊN</th>
                                <th style="width:205px;">EMAIL</th>
                                <th class="text-center" style="width:60px;">QUYỀN</th>
                                <th class="text-center" style="width:64px;"> TRẠNG THÁI</th>
                                <th class="text-center" style="width:64px;"> ĐẶT LẠI MK</th>
                                <th class="text-center" style="width:64px;"> HÀNH ĐỘNG</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $value)
                            <tr id="tr-{{ $value->id }}">
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $value->name }}</td>
                                <td class="align-middle">{{ $value->email }}</td>
                                <td id="role-{{ $value->id }}" class="align-middle text-center" onclick="editRole('{{ $value->id }}', '{{ $value->name }}', '{{ $value->role }}')">
                                    @if($value->role == 'user')
                                    <span class="btn btn-sm btn-secondary" title="Tài khoản có quyền user">User</span>
                                    @elseif($value->role == 'staff')
                                    <span class="btn btn-sm btn-success" title="Tài khoản có quyền mode">Staff</span>
                                    @else
                                    <span class="btn btn-sm btn-warning" title="Tài khoản có quyền admin">Admin</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <span id="status-{{ $value->id }}" class="btn btn-sm btn-secondary" onclick="EditStatus('{{ $value->id }}', '{{ $value->name }}', '{{ $value->status }}')">
                                        @if($value->status == 'active')
                                        <i class="fas fa-user-check" title="Tài khoản đang hoạt động"></i>
                                        @elseif($value->status == 'lock')
                                        <i class="fas fa-user-lock" title="Tài khoản bị khóa"></i>
                                        @else
                                        <i class="fas fa-user-slash" title="Tài khoản bị xóa"></i>
                                        @endif
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="btn btn-sm btn-secondary" title="Đặt lại mật khẩu" onclick="ResetPassword('{{ $value->id }}', '{{ $value->name }}')">
                                        <i class="fas fa-sync"></i>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-icon btn-danger" onclick="DeleteUser('{{ $value->name }}', '{{ $value->id }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- thanh trang -->
            </div>
        </div>
    </div>
</div>

<form action="{{ route('backend.user.add') }}" method="post" onsubmit="return checkAdd()">
    @csrf
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addModalLabel" style="width: 100%;">THÊM TÀI KHOẢN MỚI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" style="width: 100%;">
                            <b><i class="fas fa-user"></i> Tên hiển thị</b>
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                            <span id="max-length-name" class="text-danger float-right"></span>
                        </label>
                        <input type="text" class="form-control" id="name" name="name" maxlength="42" placeholder="Tên hiển thị của bạn là?" required />
                    </div>
                    <div class="form-group">
                        <label for="email" style="width: 100%;">
                            <b><i class="fas fa-envelope"></i> Email</b>
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                            <span id="max-length-email" class="text-danger float-right"></span>
                        </label>
                        <input type="email" class="form-control" id="email" autocomplete="off" name="email" maxlength="255" placeholder="Email của bạn là?" required />
                        <div class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i><strong id="emai-error"></strong></div>
                    </div>
                    <div class="form-group">
                        <label for="password" style="width: 100%;">
                            <b><i class="fas fa-lock-alt"></i> Mật khẩu</b>
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                            <span id="max-length-password" class="text-danger float-right"></span>
                        </label>
                        <input type="password" class="form-control" id="password" name="password" maxlength="255" placeholder="Mật khẩu của bạn là?" required />
                    </div>
                    <div class="form-group">
                        <label for="role">
                            <b><i class="fas fa-user-shield"></i> Loại tài khoản</b>
                            <abbr title="Bắt buộc chọn">(*)</abbr>
                        </label>
                        <select class="custom-select" id="role" name="role" required>
                            <option value="">-- Chọn --</option>
                            <option value="user">User</option>
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="text-center pb-3">
                    <button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Lưu Tài Khoản Mới</button>
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
    var check_pass = false;
    var check_edit_mail = true;

    $(document).ready(function() {
        $('#btn-add-model').click(function() {
            $('#addModal').modal('show');
        });

        //kiểm tra email
        $('#email').keyup(function() {
            var max = 255;
            var curr = max - $(this).val().length;
            var key = $(this).val();

            if ($(this).val() != '') {
                $.ajax({
                    url: "{{ route('frontend.check_email') }}",
                    data: {
                        email: key,
                        _token: token
                    },
                    type: 'post',
                    success: function(data_return) {
                        if (data_return == '0') {
                            $('#email').removeClass('is-invalid');
                            $('#email').addClass('is-valid');
                            check_add = true;
                        } else {
                            $('#email').removeClass('is-valid');
                            $('#email').addClass('is-invalid');
                            $('#emai-error').text('Email [' + key + '] đã được sử dụng!');
                            check_add = false;
                        }
                    }
                });
                $('#max-length-email').text('[Còn lại: ' + curr + ' ký tự]');
            } else {
                $('#email').removeClass('is-valid');
                $('#email').addClass('is-invalid');
                $('#max-length-email').text('');
                $('#emai-error').text('Email không được bỏ trống!');
                check_add = false;
            }
        });

        //kiểm tra độ dài chuỗi
        $('#name').keyup(function() {
            var max = 42;
            var curr = max - $(this).val().length;
            var key = $(this).val();

            if ($(this).val() != '') {
                $('#max-length-name').text('[Còn lại: ' + curr + ' ký tự]');
            } else {
                $('#max-length-name').text('');
            }
        });

        //kiểm tra mật khẩu
        $('#password').keyup(function() {
            var max = 42;
            var curr = max - $(this).val().length;
            var key = $(this).val();

            if ($(this).val() != '') {
                if (key.length <= 2) {
                    $('#max-length-password').text('YẾU');
                    $('#password').removeClass('is-valid');
                    $('#password').addClass('is-invalid');
                    check_pass = false;
                } else if (key.length > 2 && key.length <= 4) {
                    $('#max-length-password').text('TRUNG BÌNH');
                    $('#password').removeClass('is-valid');
                    $('#password').addClass('is-invalid');
                    check_pass = false;
                } else if (key.length > 4 && key.length <= 6) {
                    $('#max-length-password').text('KHÁ');
                    $('#password').removeClass('is-valid');
                    $('#password').addClass('is-invalid');
                    check_pass = true;
                } else {
                    $('#max-length-password').text('MẠNH');
                    $('#password').removeClass('is-invalid');
                    $('#password').addClass('is-valid');
                    check_pass = true;
                }

            } else {
                $('#max-length-password').text('YẾU');
                $('#password').removeClass('is-valid');
                $('#password').addClass('is-invalid');
                check_pass = false;
            }
        });


        //kiểm tra độ dài chuỗi
        $('#edit-name').keyup(function() {
            var max = 42;
            var curr = max - $(this).val().length;
            var key = $(this).val();

            if ($(this).val() != '') {
                $('#edit-max-length-name').text('[Còn lại: ' + curr + ' ký tự]');
            } else {
                $('#edit-max-length-name').text('');
            }
        });
    });

    function checkAdd() {
        if (!check_add)
            return false;

        if (!check_pass)
            return false;

        return true;
    }

    function checkEdit() {
        if (!check_edit_mail) {
            return false;
        }

        return true;
    }

    //đặt lại mật khẩu
    function ResetPassword(id, name) {
        $.confirm({
            title: '<i class="fas fa-exclamation-triangle"></i> Cảnh Báo',
            content: 'Bạn có muốn <b>đặt lại mật khẩu</b> tài khoản [<b>' + name + '</b>] không?',
            type: 'red',
            buttons: {
                deleteUser: {
                    text: '<i class="fas fa-sync"></i> Đặt Lại Mật Khẩu',
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: "{{ route('backend.user.reset_password') }}",
                            data: {
                                id: id,
                                _token: token
                            },
                            type: 'post',
                            success: function() {
                                $.alert('- Đã đặt lại mật khẩu cho tài khoản [<b>' + name + '</b>].<br/><br/>- Mật khẩu mạc định là <b>00000000</b>, vui lòng đăng nhập và đổi lại mật khẩu!');
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

    function EditStatus(id, name, status) {
        $.confirm({
            title: '<i class="fas fa-user-cog"></i> THIẾT LẬP TRẠNG THÁI',
            content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Tên tài khoản</label>' +
                '<input type="text" class="form-control" id="tmp_name" disabled/>' +
                '</div>' +

                '<div class="form-group">' +
                '<label>Trạng thái hoạt động</label>' +
                '<select class="custom-select" id="edit-status" name="status" required>' +
                '<option value="active">Active</option>' +
                '<option value="lock">Lock</option>' +
                '</select>' +
                '</div>' +
                '</form>',
            type: 'orange',
            buttons: {
                formSubmit: {
                    text: '<i class="fas fa-sync-alt"></i> Cập Nhật',
                    btnClass: 'btn-blue',
                    action: function() {
                        var status_tmp = this.$content.find('#edit-status').val();

                        $.ajax({
                            url: "{{ route('backend.user.change_status') }}",
                            data: {
                                id: id,
                                status: status_tmp,
                                _token: token
                            },
                            type: 'post',
                            success: function(data_return) {
                                if (status_tmp == 'active') {
                                    $('#status-' + id).html('<i class="fas fa-user-check" title="Tài khoản đang hoạt động"></i>');
                                } else if (status_tmp == 'lock') {
                                    $('#status-' + id).html('<i class="fas fa-user-lock" title="Tài khoản bị khóa"></i>');
                                } else {
                                    $('#status-' + id).html('<i class="fas fa-user-slash" title="Tài khoản bị xóa"></i>');
                                }

                                $.alert('Đã cập nhật trạng thái của tài khoản [<b>' + name + '</b>] thành [<b>' + status_tmp + '</b>]');
                                // $('#Order-Detail-Note-Content').text('Cập nhật trạng thái thành công!');
                                // $('#OrderNote').modal('show');
                            }
                        });
                    }
                },
                cancelAction: {
                    text: 'Đóng',
                }
            },
            onContentReady: function() {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function(e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });

                $('#tmp_name').val(name);
                $("#edit-status option[value='" + status + "']").attr("selected", "selected");
            }
        });
    }

    function editRole(id, name, status) {
        $.confirm({
            title: '<i class="fas fa-user-shield"></i> THIẾT LẬP QUYỀN',
            content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Tên tài khoản</label>' +
                '<input type="text" class="form-control" id="tmp_name" disabled/>' +
                '</div>' +

                '<div class="form-group">' +
                '<label>Trạng thái hoạt động</label>' +
                '<select class="custom-select" id="edit-status" name="status" required>' +
                '<option value="user">User</option>' +
                '<option value="staff">Staff</option>' +
                '<option value="admin">Admin</option>' +
                '</select>' +
                '</div>' +
                '</form>',
            type: 'orange',
            buttons: {
                formSubmit: {
                    text: '<i class="fas fa-sync-alt"></i> Cập Nhật',
                    btnClass: 'btn-blue',
                    action: function() {
                        var status_tmp = this.$content.find('#edit-status').val();

                        $.ajax({
                            url: "{{ route('backend.user.change_role') }}",
                            data: {
                                id: id,
                                role: status_tmp,
                                _token: token
                            },
                            type: 'post',
                            success: function(data_return) {
                                if (status_tmp == 'user') {
                                    $('#role-' + id).html('<span class="btn btn-sm btn-secondary" title="Tài khoản có quyền user">User</span>');
                                } else if (status_tmp == 'staff') {
                                    $('#role-' + id).html('<span class="btn btn-sm btn-success" title="Tài khoản có quyền mode">Staff</span>');
                                } else {
                                    $('#role-' + id).html('<span class="btn btn-sm btn-warning" title="Tài khoản có quyền admin">Admin</span>');
                                }

                                $.alert('Đã cập nhật quyền của tài khoản [<b>' + name + '</b>] thành [<b>' + status_tmp + '</b>]');
                                // $('#Order-Detail-Note-Content').text('Cập nhật quyền thành công!');
                                // $('#OrderNote').modal('show');
                            }
                        });
                    }
                },
                cancelAction: {
                    text: 'Đóng',
                }
            },
            onContentReady: function() {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function(e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });

                $('#tmp_name').val(name);
                $("#edit-status option[value='" + status + "']").attr("selected", "selected");
            }
        });
    }

    function DeleteUser(name, id_type) {
        $.confirm({
            title: '<i class="fas fa-exclamation-triangle"></i> Cảnh Báo',
            content: 'Bạn có muốn <b>xóa</b> tài khoản [<b>' + name + '</b>] không?',
            type: 'red',
            buttons: {
                deleteUser: {
                    text: '<i class="fas fa-trash"></i> Xóa Vĩnh Viễn',
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: "{{ route('backend.user.delete') }}",
                            data: {
                                id: id_type,
                                _token: token
                            },
                            type: 'post',
                            success: function(data_return) {
                                if (data_return != 1) {
                                    $.confirm({
                                        title: '<i class="fas fa-exclamation-triangle"></i> Thông Báo',
                                        content: 'Bạn không thể xóa vì tài khoản [' + name + '] <b>đang được sử dụng</b>.',
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
</script>
@endsection