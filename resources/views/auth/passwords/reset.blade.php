<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>{{ config('app.name') }} - Đặt Lại Mật Khẩu</title>
    <link rel="shortcut icon" href="{{ asset('public/logo/logo.jpg') }}" />
    <meta name="theme-color" content="#3063A0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" />
    <link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backend/assets/stylesheets/theme.min.css') }}" data-skin="default" />
    <link rel="stylesheet" href="{{ asset('public/backend/assets/stylesheets/theme-dark.min.css') }}" data-skin="dark" />
    <link rel="stylesheet" href="{{ asset('public/backend/assets/stylesheets/custom.css') }}" />
    <link type="text/css" href="{{ asset('public/css/jquery-confirm.min.css') }}" rel="stylesheet">
    <script>
        var skin = localStorage.getItem('skin') || 'default';
        var isCompact = JSON.parse(localStorage.getItem('hasCompactMenu'));
        var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
        disabledSkinStylesheet.setAttribute('rel', '');
        disabledSkinStylesheet.setAttribute('disabled', true);
        if (isCompact == true) document.querySelector('html').classList.add('preparing-compact-menu');
    </script>
</head>

<body>
    <main class="auth auth-floated">
        <form class="auth-form" action="{{ route('resetpass.postUpdatePassword') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-4">
                <div class="mb-3">
                    <img class="rounded" src="{{ asset('public/logo/logo.jpg') }}" alt="" height="72">
                </div>
                <h1 class="h3 text-uppercase">Đặt Lại Mật Khẩu</h1>
            </div>
            <p class="text-center mb-4">
                Bạn chưa có tài khoản? <a href="{{ route('frontend.register') }}">Đăng ký</a>
            </p>
            <div class="form-group mb-4">
                <label class="d-block text-left" for="inputUser">Địa chỉ email</label>
                <input type="email" id="inputUser" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" autocomplete="off" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label class="d-block text-left" for="inputPassword">Mật khẩu mới</label>
                <input type="password" id="inputPassword" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" autocomplete="new-password" required>
                @error('password')
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label class="d-block text-left" for="confirm">Nhập lại mật khẩu</label>
                <input type="password" id="confirm" class="form-control form-control-lg" name="password_confirmation" autocomplete="new-password" required>
            </div>
            <div class="form-group mb-4 mt-2">
                <button class="btn btn-lg btn-block text-light" style="background-color: #f57224;" type="submit">Xác Nhận</button>
            </div>
            <p class="mb-0 px-3 text-muted text-center">
                © @php echo date('Y') @endphp All Rights Reserved. <a href="{{ route('frontend.term') }}">Điều Khoản</a> & <a href="{{ route('frontend.policy') }}">Chính Sách</a>
            </p>
        </form>
        <div id="announcement" class="auth-announcement" style="background-image: url({{ asset('public/images/ecommerce-management-sappiencia.gif') }});">
            <div class="announcement-body">
                <a href="{{ route('frontend') }}" class="btn btn-warning"><i class="fa fa-fw fa-angle-right"></i> Trang Chủ</a>
            </div>
        </div>

    </main>
    <script src="{{ asset('public/backend/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('public/js/main.js') }}"></script>
    <script src="{{ asset('public/backend/assets/vendor/particles.js/particles.min.js') }}"></script>
    <script>
        $(document).on('theme:init', () => {
            particlesJS.load('announcement', "{{ asset('public/backend/assets/javascript/pages/particles.json') }}");
        });
    </script>
    <script src="{{ asset('public/backend/assets/javascript/theme.min.js') }}"></script>
</body>

</html>