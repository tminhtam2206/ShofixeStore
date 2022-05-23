<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Gửi Email Xác Thực Thành Công</title>
	<link rel="shortcut icon" href="{{ asset('public/logo/logo.jpg') }}" />
	<meta name="theme-color" content="#3063A0" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" />
	<link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/backend/assets/stylesheets/theme.min.css') }}" data-skin="default" />
	<link rel="stylesheet" href="{{ asset('public/backend/assets/stylesheets/theme-dark.min.css') }}" data-skin="dark" />
	<link rel="stylesheet" href="{{ asset('public/backend/assets/stylesheets/custom.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}" />
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
	<main id="comingsoon" class="empty-state empty-state-fullpage bg-primary text-white" style="background-image: url(assets/images/illustration/img-1.png);">
		<div class="empty-state-container">
			<h1 class="state-header" style="letter-spacing: 4px;">PHẢN HỒI THÀNH CÔNG</h1>
			<p class="state-description lead">Chúng tôi sẽ xem phản hồi của bạn, cảm ơn bạn đã ghé thăm trang web của chúng tôi.</p>
			<a class="btn btn-warning" href="{{ route('frontend') }}"><i class="fas fa-sign-in-alt"></i> Trang Chủ</a>
			<div class="state-action mt-2">
				<a href="#" class="btn btn-reset">
                    <i class="fab fa-fw fa-facebook"></i>
                </a>
                <a href="#" class="btn btn-reset">
                    <i class="fab fa-fw fa-twitter"></i>
                </a>
                <a href="#" class="btn btn-reset">
                    <i class="fab fa-fw fa-instagram"></i>
                </a>
                <a href="#" class="btn btn-reset">
                    <i class="fab fa-fw fa-linkedin"></i>
                </a>
			</div>
		</div>
	</main>
	<script src="{{ asset('public/backend/assets/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('public/backend/assets/vendor/popper.js/umd/popper.min.js') }}"></script>
	<script src="{{ asset('public/backend/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/backend/assets/vendor/particles.js/particles.min.js') }}"></script>
	<script src="{{ asset('public/backend/assets/javascript/theme.min.js') }}"></script>
	<script>
		$(document).on('theme:init', () => {
			particlesJS.load('comingsoon', 'assets/javascript/pages/particles-comingsoon.json');
			var countDownDate = new Date('October 10, 2020 15:37:25').getTime();
			var countDownFormater = function (i) {
				return i < 10 ? '0' + i : i;
			}
			var countDown = setInterval(function () {
				var now = new Date().getTime();
				var distance = countDownDate - now;
				var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);
				document.querySelector('#clock').innerHTML = '' + '<div class="countdown-item">' + countDownFormater(days) + ' <small>Days<\/small><\/div>' + '<div class="countdown-item">' + countDownFormater(hours) + ' <small>Hr<\/small><\/div>' + '<div class="countdown-item">' + countDownFormater(minutes) + ' <small>Min<\/small><\/div>' + '<div class="countdown-item">' + countDownFormater(seconds) + ' <small>Sec<\/small><\/div>';
				if (distance < 0) {
					clearInterval(countDown);
					document.querySelector('#clock').innerHTML = 'We\'ll Live Soon';
				}
			}, 1000);
		});
	</script>
</body>
</html>