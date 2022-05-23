@extends('frontend_manager.my_account.profile')
@section('title', 'Thiết Lập Tài Khoản')
@section('child-content')
<input id="token" type="text" value="{{ csrf_token() }}" hidden>
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{ route('frontend.my_account.profile') }}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Tổng Quan</a>
            </li>
        </ol>
    </nav>
</header>
<div class="page-section">
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-fluid">
                <h6 class="card-header">Chi Tiết Tài Khoản</h6>
                <nav class="nav nav-tabs flex-column border-0">
                    <span id="btn-profile" class="my-nav-link nav-link active" style="cursor: pointer;"><i class="fas fa-id-card"></i> Hồ Sơ</span>
                    <span id="btn-account" class="my-nav-link nav-link" style="cursor: pointer;"><i class="fas fa-user-shield"></i> Tài Khoản</span>
                    <span id="btn-change-pass" class="my-nav-link nav-link" style="cursor: pointer;"><i class="fas fa-key"></i> Đổi Mật Khẩu</span>
                    <span id="btn-change-email" class="my-nav-link nav-link" style="cursor: pointer;"><i class="fas fa-envelope"></i> Đổi Email</span>
                    <span id="btn-setting" class="my-nav-link nav-link" style="cursor: pointer;"><i class="fas fa-map-marker-alt"></i> Địa Chỉ Nhận Hàng</span>
                </nav>
            </div>
        </div>
        <div class="col-lg-8">
            <!-- start profile -->
            <div id="edit-profile" class="card card-fluid">
                <h6 class="card-header"><i class="fas fa-id-card"></i> HỒ SƠ CÔNG KHAI</h6>
                <div class="card-body">
                    <div class="media mb-3">
                        <div class="user-avatar user-avatar-xl fileinput-button">
                            <div class="fileinput-button-label">Đổi ảnh đại diện</div>
                            <img id="avatar-temp" src="{{ asset('storage/app/public/avatar').'/'.Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                            <input id="insert_image" type="file" name="avatar" accept=".jpg,.png,.webp">
                        </div>
                        <div class="media-body pl-3">
                            <h3 class="card-title">Ảnh đại diện</h3>
                            <h6 class="card-subtitle text-muted">Click vào ảnh đại diện hiện tại để thay đổi avatar.</h6>
                            <p class="card-text">
                                <small>JPG, GIF hoặc PNG.</small>
                            </p>
                            <div id="progress-avatar" class="progress progress-xs fade">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="change-name" class="col-md-3">Tên hiển thị</label>
                        <div class="col-md-9 mb-3">
                            <input type="text" class="form-control" id="change-name" placeholder="Tên hiển thị của bạn là?" value="{{ Auth::user()->name }}" maxlength="42" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="change-introduce" class="col-md-3">Giới thiệu</label>
                        <div class="col-md-9 mb-3">
                            <textarea class="form-control" id="change-introduce" placeholder="Một chút giới thiệu về bản thân!" maxlength="255">{{ Auth::user()->introduce }}</textarea>
                            <small class="text-muted">Giới thiệu sẽ xuất hiện trên trang hồ sơ của bạn, tối đa 255 ký tự.</small>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end profile -->

            <!-- start account -->
            <div id="edit-account" class="card card-fluid" style="display: none;">
                <h6 class="card-header"><i class="fas fa-user-shield"></i> TÀI KHOẢN CỦA TÔI</h6>
                <div class="card-body">
                    <form method="post">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="input01">Username</label>
                                <input type="text" class="form-control" id="input01" value="{{ Str::before(Auth::user()->email, '@') }}" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="input02">Loại tài khoản</label>
                                <input type="text" class="form-control" id="input02" value="#{{ Auth::user()->role }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tên hiển thị</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="my-email">Email</label>
                            <input type="email" class="form-control" id="my-email" name="email" value="{{ Auth::user()->email }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="input04">Mật khẩu</label>
                            <input type="password" class="form-control" id="input04" value="**********" disabled>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end account -->

            <!-- start notifile -->
            <div id="edit-notifi" class="card card-fluid" style="display: none;">
                <h6 class="card-header"><i class="fas fa-bell"></i> ĐỊA CHỈ NHẬN HÀNG</h6>
                <div class="card-body">
                    <div class="form-group">
                        <label class="control-label" for="bss3">Địa chỉ hiện có</label>
                        <select id="bss3" data-toggle="selectpicker" data-live-search="true" data-width="100%">
                            @foreach($address as $value)
                            <option value="{{ $value->id }}" @if($value->status == 'YES') selected @endif>{{ $value->name.', '.$value->phone.', '.$value->address }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- end notifile -->

            <!-- start change password -->
            <div id="edit-password" class="card card-fluid" style="display: none;">
                <h6 class="card-header"><i class="fas fa-key"></i> THAY ĐỔI MẬT KHẨU</h6>
                <div class="card-body">
                    <form method="post" action="{{ route('frontend.my_account.change_pass') }}" onsubmit="return checkFormPass()">
                        @csrf
                        <div class="form-group">
                            <label for="new-pass">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="new-pass" name="newPassword" maxlength="255" placeholder="Mật khẩu phải có ít nhất 6 ký tự" required>
                        </div>
                        <div class="form-group">
                            <label for="re-pass">Nhập lại mật khẩu</label>
                            <input type="password" id="re-pass" class="form-control" maxlength="255" placeholder="Nhập lại mật khẩu vừa rồi" required>
                        </div>

                        <hr>
                        <div class="form-actions">
                            <input type="password" class="form-control mr-3" id="confirm-pass" name="oldPassword" placeholder="Nhập lại mật khẩu cũ để xác nhận đây chính là bạn" maxlength="255" required>
                            <button type="submit" class="btn btn-primary text-nowrap ml-auto">Cập Nhật Mật Khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end change password -->

            <!-- start change email -->
            <div id="edit-email" class="card card-fluid" style="display: none;">
                <h6 class="card-header"><i class="fas fa-envelope"></i> THAY ĐỔI EMAIL</h6>
                <div class="card-body">
                    <form method="post" action="{{ route('frontend.my_account.change_email') }}" onsubmit="return checkFormEmail()">
                        @csrf
                        <div class="form-group">
                            <label>Email hiện tại</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="new-email">Email mới</label>
                            <input type="email" class="form-control" id="new-email" name="email" autocomplete="off" placeholder="Hãy nhập email mới của bạn" maxlength="255" required>
                            <div class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i><strong id="email-error"></strong></div>
                        </div>
                        <hr>
                        <div class="form-actions">
                            <input type="password" class="form-control mr-3" name="confirmPassword" placeholder="Nhập mật khẩu để xác nhận đây chính là bạn" required>
                            <button type="submit" class="btn btn-primary text-nowrap ml-auto">Cập Nhật Email</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end change email -->
        </div>
    </div>
</div>

<!-- start modal change avatar -->
<div id="insertimageModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="width: 100%;">
                <h4 class="modal-title text-center" style="width: 100%;">CHỈNH SỬA ẢNH ĐẠI DIỆN</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="image_demo" style="width:100%; margin-top:30px"></div>
            </div>
            <div class="modal-footer" style="width: 100%;">
                <div class="text-center" style="width: 100%;"><button class="btn btn-success crop_image">Cập Nhật Ảnh Đại Diện</button></div>
            </div>
        </div>
    </div>
</div>
<!-- end modal change avatar -->
@endsection

@section('javascript')
<script>
    var ext_avatar = "";
    var check_mail = false;

    $('#new-email').keyup(function() {
        var keys = $(this).val();
        var token = $('#token').val();

        if ($(this).val() != '') {
            $.ajax({
                url: "{{ route('frontend.check_email') }}",
                data: {
                    email: keys,
                    _token: token
                },
                type: 'post',
                success: function(data_return) {
                    if (data_return == '0') {
                        $('#new-email').removeClass('is-invalid');
                        $('#new-email').addClass('is-valid');
                        $('#email-error').text('');
                        check_mail = true;
                    } else {
                        $('#new-email').removeClass('is-valid');
                        $('#new-email').addClass('is-invalid');
                        $('#email-error').text('Email đã được sử dụng!');
                        check_mail = false;
                    }
                }
            });
        } else {
            $('#new-email').removeClass('is-valid');
            $('#new-email').addClass('is-invalid');
            $('#email-error').text('Email không được bỏ trống!');
            check_mail = false;
        }
    });

    function checkFormEmail() {
        if (!check_mail) {
            return false;
        }

        return true;
    }

    $('#btn-profile').click(function() {
        $('.my-nav-link').removeClass('active');
        $('#edit-notifi').hide();
        $('#edit-account').hide();
        $('#edit-password').hide();
        $('#edit-email').hide();
        $(this).addClass('active');
        $('#edit-profile').show();
    });

    $('#btn-account').click(function() {
        $('.my-nav-link').removeClass('active');
        $('#edit-notifi').hide();
        $('#edit-profile').hide();
        $('#edit-password').hide();
        $('#edit-email').hide();
        $(this).addClass('active');
        $('#edit-account').show();
    });

    $('#btn-setting').click(function() {
        $('.my-nav-link').removeClass('active');
        $('#edit-profile').hide();
        $('#edit-account').hide();
        $('#edit-password').hide();
        $('#edit-email').hide();
        $(this).addClass('active');
        $('#edit-notifi').show();
    });

    $('#btn-change-pass').click(function() {
        $('.my-nav-link').removeClass('active');
        $('#edit-profile').hide();
        $('#edit-account').hide();
        $('#edit-notifi').hide();
        $('#edit-email').hide();
        $(this).addClass('active');
        $('#edit-password').show();
    });

    $('#btn-change-email').click(function() {
        $('.my-nav-link').removeClass('active');
        $('#edit-profile').hide();
        $('#edit-account').hide();
        $('#edit-notifi').hide();
        $('#edit-password').hide();
        $(this).addClass('active');
        $('#edit-email').show();
    });

    var check_pass = false;
    var check_repass = false;

    $('#new-pass').keyup(function() {
        if ($(this).val() != '') {
            if (checkLength($(this).val(), 6)) {
                $('#new-pass').removeClass('is-invalid');
                $('#new-pass').addClass('is-valid');
                check_pass = true;
            } else {
                $('#new-pass').removeClass('is-valid');
                $('#new-pass').addClass('is-invalid');
                check_pass = false;
            }
        } else {
            $('#new-pass').removeClass('is-valid');
            $('#new-pass').addClass('is-invalid');
            check_pass = false;
        }
    });

    $('#re-pass').keyup(function() {
        if ($(this).val() != '') {
            if (my_compare($('#new-pass').val(), $(this).val())) {
                $('#re-pass').removeClass('is-invalid');
                $('#re-pass').addClass('is-valid');
                check_repass = true;
            } else {
                $('#re-pass').removeClass('is-valid');
                $('#re-pass').addClass('is-invalid');
                check_repass = false;
            }
        } else {
            $('#re-pass').removeClass('is-valid');
            $('#re-pass').addClass('is-invalid');
            check_repass = false;
        }
    });

    function checkFormPass() {
        if (!check_pass || !check_repass) {
            return false;
        }
        return true;
    }

    $('#change-name').keyup(function() {
        let name_val = $(this).val();

        if (name_val != '') {
            $.ajax({
                url: "{{ route('frontend.my_account.chang_name') }}",
                data: {
                    name: $(this).val(),
                    _token: $('#token').val()
                },
                type: 'post',
                success: function() {
                    $('#focus-change-name').text(name_val);
                    $('#focus-change-name-2').text(name_val);
                }
            });
        }
    });

    $('#change-introduce').keyup(function() {
        let name_val = $(this).val();

        if (name_val != '') {
            $.ajax({
                url: "{{ route('frontend.my_account.chang_introduce') }}",
                data: {
                    introduce: $(this).val(),
                    _token: $('#token').val()
                },
                type: 'post',
                success: function() {
                    $('#focus-introduce').text(name_val);
                }
            });
        }
    });
</script>

<!-- start change and drop image -->
<script>
    $(document).ready(function() {
        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square' //circle
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#insert_image').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#insertimageModal').modal('show');
        });

        $('.crop_image').click(function(event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response) {
                $.ajax({
                    url: "{{ route('frontend.my_account.change_avatar') }}",
                    type: 'post',
                    data: {
                        "image": response,
                        _token: $('#token').val()
                    },
                    success: function(data_return) {
                        $('#insertimageModal').modal('hide');
                        $('#avatar-temp').attr('src', data_return);
                        $('#focus-change-avatar').attr('src', data_return);
                        $('#focus-change-avatar-2').attr('src', data_return);
                        $('#focus-change-avatar-3').attr('src', data_return);
                    }
                })
            });
        });
    });

    $('#bss3').change(function(){
        $.ajax({
            url: "{{ route('frontend.my_account.updateAddress') }}",
            data: {id: $(this).val()},
            type: 'get',
            success:function(){

            }
        });
    });
</script>
<!-- end change and drop image -->


@if(Session::has('errorPass'))
<script>
    Error("Mật khẩu cũ không đúng!")
</script>
@endif
@if(Session::has('successPass'))
<script>
    Alert("Thay đổi mật khẩu thành công!")
</script>
@endif

@if(Session::has('errorEmail'))
<script>
    Error("Mật khẩu xác nhận <b>thay đổi email</b> không đúng!")
</script>
@endif
@if(Session::has('successEmail'))
<script>
    Alert("Thay <b>đổi email thành công</b>!")
</script>
@endif
@if(session('my_choose') == 'change_email')
{{ session()->forget('my_choose') }}
<script>
    $('#btn-change-email').click();
</script>
@endif

@if(session('my_choose') == 'change_password')
{{ session()->forget('my_choose') }}
<script>
    $('#btn-change-pass').click();
</script>
@endif
@endsection