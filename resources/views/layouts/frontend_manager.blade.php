<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>@yield('title', '') - {{ config('app.name') }}</title>
	<link rel="shortcut icon" href="{{ asset('public/logo/logo.jpg') }}" />
	<meta name="theme-color" content="#3063A0" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" />
	<link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/open-iconic/css/open-iconic-bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}" />

	<link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" />

	<link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/flatpickr/flatpickr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/backend/assets/stylesheets/theme.min.css') }}" data-skin="default" />
	<link rel="stylesheet" href="{{ asset('public/backend/assets/stylesheets/theme-dark.min.css') }}" data-skin="dark" />
	<link rel="stylesheet" href="{{ asset('public/backend/assets/stylesheets/custom.css') }}" />
	<link type="text/css" href="{{ asset('public/css/jquery-confirm.min.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('public/backend/css/jquery.dataTables.min.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('public/css/app.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('public/css/croppie.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('public/css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/select2/css/select2.min.css') }}">
	

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
	<div class="app">
		<header class="app-header app-header-dark">
			<div class="top-bar">
				<div class="top-bar-brand">
					<button class="hamburger hamburger-squeeze mr-2" type="button" data-toggle="aside-menu" aria-label="toggle aside menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
					<a href="{{ route('frontend.user_manager') }}">
						<img src="{{ asset('public/frontend/img/logo/2.png') }}" style="width: 100%; height: 50px;">
					</a>
				</div>
				<div class="top-bar-list">
					<div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
						<button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="toggle menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
					</div>
					<!-- message -->
					<div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
						<ul class="header-nav nav">
							<li class="nav-item dropdown header-nav-dropdown has-notified">
								<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-bell"></span></a>
								<div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
									<div class="dropdown-arrow"></div>
									<h6 class="dropdown-header stop-propagation">
										<span>Thông Báo <span class="badge">(2)</span></span>
									</h6>
									<div class="dropdown-scroll perfect-scrollbar">
										<a href="#" class="dropdown-item unread">
											<div class="user-avatar">
												<img src="{{ asset('public/backend/assets/images/avatars/uifaces15.jpg') }}" alt="">
											</div>
											<div class="dropdown-item-body">
												<p class="text">Jeffrey Wells created a schedule</p><span class="date">Just now</span>
											</div>
										</a>
										<a href="#" class="dropdown-item unread">
											<div class="user-avatar">
												<img src="{{ asset('public/backend/assets/images/avatars/uifaces16.jpg') }}" alt="">
											</div>
											<div class="dropdown-item-body">
												<p class="text">Anna Vargas logged a chat</p><span class="date">3 hours ago</span>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="user-avatar">
												<img src="{{ asset('public/backend/assets/images/avatars/uifaces17.jpg') }}" alt="">
											</div>
											<div class="dropdown-item-body">
												<p class="text">Sara Carr invited to Stilearn Admin</p><span class="date">5 hours ago</span>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="user-avatar">
												<img src="{{ asset('public/backend/assets/images/avatars/uifaces18.jpg') }}" alt="">
											</div>
											<div class="dropdown-item-body">
												<p class="text">Arthur Carroll updated a project</p><span class="date">1 day ago</span>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="user-avatar">
												<img src="{{ asset('public/backend/assets/images/avatars/uifaces19.jpg') }}" alt="">
											</div>
											<div class="dropdown-item-body">
												<p class="text">Hannah Romero created a task</p><span class="date">1 day ago</span>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="user-avatar">
												<img src="{{ asset('public/backend/assets/images/avatars/uifaces20.jpg') }}" alt="">
											</div>
											<div class="dropdown-item-body">
												<p class="text">Angela Peterson assign a task to you</p><span class="date">2 days ago</span>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="user-avatar">
												<img src="{{ asset('public/backend/assets/images/avatars/uifaces21.jpg') }}" alt="">
											</div>
											<div class="dropdown-item-body">
												<p class="text">Shirley Mason and 3 others followed you</p><span class="date">2 days ago</span>
											</div>
										</a>
									</div>
									<a href="user-activities.html" class="dropdown-footer">Tất cả thông báo <i class="fas fa-fw fa-long-arrow-alt-right"></i></a>
								</div>
							</li>
							<li class="nav-item dropdown header-nav-dropdown">
								<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="oi oi-grid-three-up"></span></a>
								<div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
									<div class="dropdown-arrow"></div>
									<div class="dropdown-sheets">
										<div class="dropdown-sheet-item">
											<a href="{{ route('frontend') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-indigo"><i class="fas fa-home"></i></span>
												<span class="tile-peek">Trang Chủ</span>
											</a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('frontend.my_account.profile') }}" class="tile-wrapper"><span class="tile tile-lg bg-teal"><i class="fas fa-user"></i></span><span class="tile-peek">Tài Khoản</span></a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('frontend.order') }}" class="tile-wrapper"><span class="tile tile-lg bg-yellow"><i class="fas fa-clipboard-list"></i></span><span class="tile-peek">Đơn Hàng</span></a>
										</div>
									</div>
								</div>
							</li>
						</ul>
						<div class="dropdown d-flex">
							<button class="btn-account d-none d-md-flex" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="user-avatar user-avatar-md"><img id="focus-change-avatar" src="{{ asset('storage/app/public/avatar') }}/{{ Auth::user()->avatar }}" alt=""></span>
								<span class="account-summary pr-lg-4 d-none d-lg-block">
									<span id="focus-change-name" class="account-name">{{ Auth::user()->name }}</span>
									<span class="account-description">@if(Auth::user()->role == 'user') Khách hàng @elseif(Auth::user()->role == 'staff') Nhân viên @else Quản trị viên @endif</span>
								</span>
							</button>
							<div class="dropdown-menu">
								<div class="dropdown-arrow ml-3"></div>
								<h6 id="focus-change-name-2" class="dropdown-header d-none d-md-block d-lg-none">{{ Auth::user()->name }}</h6>
								<a class="dropdown-item" href="{{ route('frontend.my_account.profile') }}">
									<span class="dropdown-icon oi oi-person"></span> Hồ sơ Cá Nhân
								</a>
								<a class="dropdown-item" href="{{ route('frontend.logout') }}">
									<span class="dropdown-icon oi oi-account-logout"></span> Đăng Xuất
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('frontend.my_account.record') }}">
									<span class="dropdown-icon fas fa-user-clock"></span> Nhật Ký Hoạt Động
								</a>
								<a class="dropdown-item" href="{{ route('frontend.my_account.setting') }}">
									<span class="dropdown-icon fas fa-user-cog"></span> Thiết Lập Tài Khoản
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<aside class="app-aside app-aside-expand-md app-aside-light">
			<div class="aside-content">
				<header class="aside-header d-block d-md-none">
					<button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside">
						<span class="user-avatar user-avatar-lg">
							<img id="focus-change-avatar-3" src="{{ asset('storage/app/public/avatar').'/'.Auth::user()->avatar }}" alt="">
						</span>
						<span class="account-icon"><span class="fa fa-caret-down fa-lg"></span></span>
						<span class="account-summary"><span class="account-name">{{ Auth::user()->fullname }}</span>
							<span class="account-description text-capitalize">{{ Auth::user()->role }}</span></span>
					</button>
					<div id="dropdown-aside" class="dropdown-aside collapse">
						<div class="pb-3">
							<a class="dropdown-item" href="{{ route('frontend.my_account.profile') }}">
								<span class="dropdown-icon oi oi-person"></span> Hồ sơ Cá Nhân
							</a>
							<a class="dropdown-item" href="{{ route('frontend.logout') }}">
								<span class="dropdown-icon oi oi-account-logout"></span> Đăng Xuất
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{ route('frontend.my_account.record') }}">
								<span class="dropdown-icon fas fa-user-clock"></span> Nhật Ký Hoạt Động
							</a>
							<a class="dropdown-item" href="{{ route('frontend.my_account.setting') }}">
								<span class="dropdown-icon fas fa-user-cog"></span> Thiết Lập Tài Khoản
							</a>
						</div>
					</div>
				</header>
				<div class="aside-menu overflow-hidden">
					<nav id="stacked-menu" class="stacked-menu">
						<ul class="menu">
							<li class="menu-item {{ (request()->is('bang-dieu-khien')) ? 'has-active' : '' }}">
								<a href="{{ route('frontend.user_manager') }}" class="menu-link">
									<span class="menu-icon fas fa-home"></span>
									<span class="menu-text">Bảng Điều Khiển</span>
								</a>
							</li>
							<li class="menu-item has-child {{ (request()->is('tai-khoan*')) ? 'has-open' : '' }}">
								<a href="#" class="menu-link">
									<span class="menu-icon oi oi-person"></span>
									<span class="menu-text">Cá Nhân</span>
								</a>
								<ul class="menu">
									<li class="menu-item {{ (request()->is('tai-khoan/ho-so')) ? 'has-active' : '' }}">
										<a href="{{ route('frontend.my_account.profile') }}" class="menu-link"><i class="fas fa-user-shield"></i> Hồ Sơ Cá Nhân</a>
									</li>
									<li class="menu-item {{ (request()->is('tai-khoan/nhat-ky-hoat-dong')) ? 'has-active' : '' }}">
										<a href="{{ route('frontend.my_account.record') }}" class="menu-link"><i class="fas fa-user-clock"></i> Nhật Ký Hoạt Động</a>
									</li>
									<li class="menu-item {{ (request()->is('tai-khoan/thiet-lap')) ? 'has-active' : '' }}">
										<a href="{{ route('frontend.my_account.setting') }}" class="menu-link"><i class="fas fa-user-cog"></i> Thiết Lập Tài Khoản</a>
									</li>
								</ul>
							</li>
							<li class="menu-item {{ (request()->is('don-hang*')) ? 'has-active' : '' }}">
								<a href="{{ route('frontend.order') }}" class="menu-link">
									<span class="menu-icon fas fa-ballot-check"></span>
									<span class="menu-text">Đơn Hàng</span>
								</a>
							</li>
							

							<li class="menu-header">KHÁC</li>
							<li class="menu-item">
								<a href="#" class="menu-link">
									<span class="menu-icon fas fa-rocket"></span>
									<span class="menu-text">Fellback</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
				<footer class="aside-footer border-top p-2">
					<p class="text-light text-center">
						v15.2.1 @Trần Minh Tâm
					</p>
				</footer>
			</div>
		</aside>
		<main class="app-main">
			<div class="wrapper">
				<div class="page">
					<!-- start content -->
					@yield('content')
					<!-- end content -->
				</div>
			</div>
			<footer class="app-footer">
				<ul class="list-inline">
					<li class="list-inline-item">
						<a class="text-muted" href="#">Hỗ Trợ</a>
					</li>
					<li class="list-inline-item">
						<a class="text-muted" href="#">Trung Tâm Trợ Giúp</a>
					</li>
					<li class="list-inline-item">
						<a class="text-muted" href="{{ route('frontend.policy') }}">Chính Sách Bảo Mật</a>
					</li>
					<li class="list-inline-item">
						<a class="text-muted" href="{{ route('frontend.term') }}">Điều Khoản Sử Dụng</a>
					</li>
				</ul>
				<div class="copyright">Copyright © @php echo date('Y') @endphp. All right reserved.</div>
			</footer>
		</main>
	</div>

	<script src="{{ asset('public/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ asset('public/backend/assets/vendor/popper.js/umd/popper.min.js') }}"></script>
	<script src="{{ asset('public/backend/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/backend/assets/vendor/pace-progress/pace.min.js') }}"></script>
	<script src="{{ asset('public/backend/assets/vendor/stacked-menu/js/stacked-menu.min.js') }}"></script>
	<script src="{{ asset('public/backend/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
	<script src="{{ asset('public/backend/assets/vendor/flatpickr/flatpickr.min.js') }}"></script>
	<script src="{{ asset('public/backend/assets/vendor/flatpickr/plugins/monthSelect/index.js') }}"></script>
	<script src="{{ asset('public/backend/assets/vendor/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
	<script src="{{ asset('public/backend/assets/vendor/chart.js/Chart.min.js') }}"></script>
	<script src="{{ asset('public/backend/assets/javascript/theme.min.js') }}"></script>

	<script src="{{ asset('public/backend/assets/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

	
	<script src="{{ asset('public/js/jquery-confirm.min.js') }}"></script>
	<script src="{{ asset('public/js/main.js') }}"></script>
	<script src="{{ asset('public/js/app.js') }}"></script>
	<script src="{{ asset('public/backend/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('public/js/croppie.js') }}"></script>
	
	<script>
		$(document).ready(function() {
			$('#filterTable').DataTable({
				language: {
					url: "{{ asset('public/backend/js/vi.json') }}"
				},
            	"bSort": false
			});
		});
	</script>

	@yield('javascript')
</body>

</html>