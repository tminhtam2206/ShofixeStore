<!DOCTYPE html>
<html lang="">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>@yield('title', '') - {{ config('app.name') }}</title>
	<link rel="shortcut icon" href="{{ asset('public/logo/logo.jpg') }}" />
	<meta name="theme-color" content="#3063A0" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" />
	<link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/open-iconic/css/open-iconic-bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}" />

	<link rel="stylesheet" href="{{ asset('public/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" />

	<link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/flatpickr/flatpickr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/backend/assets/stylesheets/theme.min.css') }}" data-skin="default" />
	<link rel="stylesheet" href="{{ asset('public/backend/assets/stylesheets/theme-dark.min.css') }}" data-skin="dark" />
	<link rel="stylesheet" href="{{ asset('public/backend/assets/stylesheets/custom.css') }}" />
	<link type="text/css" href="{{ asset('public/css/jquery-confirm.min.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('public/backend/css/jquery.dataTables.min.css') }}" rel="stylesheet">

	<!-- <link type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" rel="stylesheet"> -->
	
	<link type="text/css" href="{{ asset('public/css/app.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('public/css/croppie.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('public/css/style.css') }}" rel="stylesheet">
	

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
					<a href="{{ route('backend') }}">
						<img src="{{ asset('public/frontend/img/logo/2.png') }}" style="width: 100%; height: 50px;">
					</a>
				</div>
				<div class="top-bar-list">
					<div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
						<button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="toggle menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
					</div>
					<div class="top-bar-item top-bar-item-full">
						<form class="top-bar-search">
							<div class="input-group input-group-search dropdown">
								<div class="input-group-prepend">
									<span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
								</div><input type="text" class="form-control" data-toggle="dropdown" aria-label="Search" placeholder="Tìm kiếm...">
								<div class="dropdown-menu dropdown-menu-rich dropdown-menu-xl ml-n4 mw-100">
									<div class="dropdown-arrow ml-3"></div>
									<div class="dropdown-scroll perfect-scrollbar h-auto" style="max-height: 360px">
										<div class="list-group list-group-flush list-group-reflow mb-2">
											<h6 class="list-group-header d-flex justify-content-between">
												<span>Shortcut</span>
											</h6>
											<div class="list-group-item py-2">
												<a href="#" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-user-plus"></i>
												</div>
												<div class="ml-2">Create user</div>
											</div>
											<div class="list-group-item py-2">
												<a href="#" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-dollar-sign"></i>
												</div>
												<div class="ml-2">Create invoice</div>
											</div>
											<h6 class="list-group-header d-flex justify-content-between mt-2">
												<span>In projects</span><a href="#" class="font-weight-normal">Show more</a>
											</h6>
											<div class="list-group-item py-2">
												<a href="#" class="stretched-link"><span class="sr-only">Go to search result</span></a>
												<div class="user-avatar user-avatar-sm bg-muted">
													<img src="{{ asset('public/backend/assets/images/avatars/bootstrap.svg') }}" alt="">
												</div>
												<div class="ml-2">
													<div class="mb-n1">Bootstrap</div><small class="text-muted">Just now</small>
												</div>
											</div>
											<div class="list-group-item py-2">
												<a href="#" class="stretched-link"><span class="sr-only">Go to search result</span></a>
												<div class="user-avatar user-avatar-sm bg-muted">
													<img src="{{ asset('public/backend/assets/images/avatars/slack.svg') }}" alt="">
												</div>
												<div class="ml-2">
													<div class="mb-n1">Slack</div><small class="text-muted">Updated 25 minutes ago</small>
												</div>
											</div>
											<h6 class="list-group-header d-flex justify-content-between mt-2">
												<span>Another section</span><a href="#" class="font-weight-normal">Show more</a>
											</h6>
											<div class="list-group-item py-2">
												<a href="#" class="stretched-link"><span class="sr-only">Go to search result</span></a>
												<div class="tile tile-sm bg-muted">P</div>
												<div class="ml-2">
													<div class="mb-n1">Product name</div>
												</div>
											</div>
										</div>
									</div>
									<a href="#" class="dropdown-footer">Show all results</a>
								</div>
							</div>
						</form>
					</div>
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
							<li class="nav-item dropdown header-nav-dropdown has-notified">
								<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="oi oi-envelope-open"></span></a>
								<div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
									<div class="dropdown-arrow"></div>
									<h6 class="dropdown-header stop-propagation">
										<span>Hộp Thư</span><a href="#">Đánh dấu đã đọc tất cả</a>
									</h6>
									<div class="dropdown-scroll perfect-scrollbar">
										<a href="#" class="dropdown-item unread">
											<div class="user-avatar">
												<img src="{{ asset('public/backend/assets/images/avatars/team1.jpg') }}" alt="">
											</div>
											<div class="dropdown-item-body">
												<p class="subject">Stilearning</p>
												<p class="text text-truncate">Invitation: Joe's Dinner @ Fri Aug 22</p><span class="date">2 hours ago</span>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="user-avatar">
												<img src="{{ asset('public/backend/assets/images/avatars/team3.png') }}" alt="">
											</div>
											<div class="dropdown-item-body">
												<p class="subject">Openlane</p>
												<p class="text text-truncate">Final reminder: Upgrade to Pro</p><span class="date">23 hours ago</span>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="tile tile-circle bg-green">GZ</div>
											<div class="dropdown-item-body">
												<p class="subject">Gogo Zoom</p>
												<p class="text text-truncate">Live healthy with this wireless sensor.</p><span class="date">1 day ago</span>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="tile tile-circle bg-teal">GD</div>
											<div class="dropdown-item-body">
												<p class="subject">Gold Dex</p>
												<p class="text text-truncate">Invitation: Design Review @ Mon Jul 7</p><span class="date">1 day ago</span>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="user-avatar">
												<img src="{{ asset('public/backend/assets/images/avatars/team2.png') }}" alt="">
											</div>
											<div class="dropdown-item-body">
												<p class="subject">Creative Division</p>
												<p class="text text-truncate">Need some feedback on this please</p><span class="date">2 days ago</span>
											</div>
										</a>
										<a href="#" class="dropdown-item">
											<div class="tile tile-circle bg-pink">LD</div>
											<div class="dropdown-item-body">
												<p class="subject">Lab Drill</p>
												<p class="text text-truncate">Our UX exercise is ready</p><span class="date">6 days ago</span>
											</div>
										</a>
									</div>
									<a href="#" class="dropdown-footer">Tất cả thư <i class="fas fa-fw fa-long-arrow-alt-right"></i></a>
								</div>
							</li>
							<li class="nav-item dropdown header-nav-dropdown">
								<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="oi oi-grid-three-up"></span></a>
								<div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
									<div class="dropdown-arrow"></div>
									<div class="dropdown-sheets">
										<div class="dropdown-sheet-item">
											<a href="{{ route('frontend') }}" target="_blank" class="tile-wrapper">
												<span class="tile tile-lg bg-indigo"><i class="fas fa-home"></i></span>
												<span class="tile-peek">Trang Chủ</span>
											</a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('backend.user.all') }}" class="tile-wrapper"><span class="tile tile-lg bg-teal"><i class="fas fa-users"></i></span><span class="tile-peek">Tài Khoản</span></a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('backend.product') }}" class="tile-wrapper"><span class="tile tile-lg bg-pink"><i class="fab fa-product-hunt"></i></span><span class="tile-peek">Sản Phẩm</span></a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('backend.order') }}" class="tile-wrapper"><span class="tile tile-lg bg-yellow"><i class="fas fa-clipboard-list"></i></span><span class="tile-peek">Đơn Hàng</span></a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('backend.statistical.basic_all') }}" class="tile-wrapper"><span class="tile tile-lg bg-cyan"><i class="fas fa-chart-bar"></i></span><span class="tile-peek">Thống Kê</span></a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('frontend.user_manager') }}" class="tile-wrapper" target="_blank"><span class="tile tile-lg bg-danger"><i class="fas fa-user"></i></span><span class="tile-peek">Quyền Khách Hàng</span></a>
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
									<span class="account-description text-capitalize">@if(Auth::user()->role == 'user') Khách hàng @elseif(Auth::user()->role == 'staff') Nhân viên @else Quản trị viên @endif</span>
								</span>
							</button>
							<div class="dropdown-menu">
								<div class="dropdown-arrow ml-3"></div>
								<h6 id="focus-change-name-2" class="dropdown-header d-none d-md-block d-lg-none">{{ Auth::user()->name }}</h6>
								<a class="dropdown-item" href="{{ route('backend.my_account.profile') }}">
									<span class="dropdown-icon oi oi-person"></span> Hồ sơ Cá Nhân
								</a>
								<a class="dropdown-item" href="{{ route('frontend.logout') }}">
									<span class="dropdown-icon oi oi-account-logout"></span> Đăng Xuất
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('backend.my_account.record') }}">
									<span class="dropdown-icon fas fa-user-clock"></span> Nhật Ký Hoạt Động
								</a>
								<a class="dropdown-item" href="{{ route('backend.my_account.setting') }}">
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
							<a class="dropdown-item" href="">
								<span class="dropdown-icon oi oi-person"></span> Hồ sơ Cá Nhân
							</a>
							<a class="dropdown-item" href="{{ route('frontend.logout') }}">
								<span class="dropdown-icon oi oi-account-logout"></span> Đăng Xuất
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{ route('backend.my_account.record') }}">
								<span class="dropdown-icon fas fa-user-clock"></span> Nhật Ký Hoạt Động
							</a>
							<a class="dropdown-item" href="{{ route('backend.my_account.setting') }}">
								<span class="dropdown-icon fas fa-user-cog"></span> Thiết Lập Tài Khoản
							</a>
						</div>
					</div>
				</header>
				<div class="aside-menu overflow-hidden">
					<nav id="stacked-menu" class="stacked-menu">
						<ul class="menu">
							<li class="menu-item {{ (request()->is('admin/dashboard')) ? 'has-active' : '' }}">
								<a href="{{ route('backend') }}" class="menu-link">
									<span class="menu-icon fas fa-home"></span>
									<span class="menu-text">Bảng Điều Khiển</span>
								</a>
							</li>
							<li class="menu-item has-child {{ (request()->is('admin/my-account*')) ? 'has-open' : '' }}">
								<a href="#" class="menu-link">
									<span class="menu-icon oi oi-person"></span>
									<span class="menu-text">Cá Nhân</span>
								</a>
								<ul class="menu">
									<li class="menu-item {{ (request()->is('admin/my-account/profile')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.my_account.profile') }}" class="menu-link"><i class="fas fa-user-shield"></i> Hồ Sơ Cá Nhân</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/my-account/record')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.my_account.record') }}" class="menu-link"><i class="fas fa-user-clock"></i> Nhật Ký Hoạt Động</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/my-account/setting')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.my_account.setting') }}" class="menu-link"><i class="fas fa-user-cog"></i> Thiết Lập Tài Khoản</a>
									</li>
								</ul>
							</li>
							<li class="menu-item has-child {{ (request()->is('admin/user*')) ? 'has-open' : '' }}">
								<a href="#" class="menu-link">
									<span class="menu-icon fas fa-users"></span>
									<span class="menu-text">Tài Khoản</span>
								</a>
								<ul class="menu">
									<li class="menu-item {{ (request()->is('admin/user/active')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.user.active') }}" class="menu-link"><i class="fas fa-user-check"></i> Hoạt Động</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/user/lock')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.user.lock') }}" class="menu-link"><i class="fas fa-user-lock"></i> Bị Khóa</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/user/all')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.user.all') }}" class="menu-link"><i class="fas fa-users"></i> Tất Cả</a>
									</li>
								</ul>
							</li>
							<li class="menu-item has-child {{ (request()->is('admin/type-product') || request()->is('admin/genaral*') || request()->is('admin/category') || request()->is('admin/brand')) ? 'has-open' : '' }}">
								<a href="#" class="menu-link">
									<span class="menu-icon fas fa-th-list"></span>
									<span class="menu-text">Quản Lý Danh Mục</span>
								</a>
								<ul class="menu">
									<li class="menu-item {{ (request()->is('admin/genaral/color')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.frame_color') }}" class="menu-link"><i class="fas fa-palette"></i> Màu Sắc</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/genaral/size')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.frame_size') }}" class="menu-link"><i class="fas fa-ruler-horizontal"></i> Kích Thước</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/type-product')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.type_product') }}" class="menu-link"><i class="fas fa-tape"></i> Loại Sản Phẩm</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/category')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.category') }}" class="menu-link"><i class="fas fa-compass"></i> Danh Mục (CHANGE)</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/brand')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.brand') }}" class="menu-link"><i class="fas fa-copyright"></i> Thương Hiệu</a>
									</li>
								</ul>
							</li>
							<li class="menu-item has-child {{ (request()->is('admin/product*')) ? 'has-open' : '' }}">
								<a href="#" class="menu-link">
									<span class="menu-icon fab fa-product-hunt"></span>
									<span class="menu-text">Sản Phẩm</span>
								</a>
								<ul class="menu">
									<li class="menu-item {{ (request()->is('admin/product/approval')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.product.approval') }}" class="menu-link"><i class="fas fa-check-double"></i> Đã Duyệt</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/product/pending')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.product.pending') }}" class="menu-link"><i class="fas fa-pennant"></i> Chờ Duyệt</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/product/all')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.product') }}" class="menu-link"><i class="fas fa-list-ol"></i> Tất Cả</a>
									</li>
								</ul>
							</li>
							<li class="menu-item has-child {{ (request()->is('admin/order*')) ? 'has-open' : '' }}">
								<a href="#" class="menu-link">
									<span class="menu-icon fas fa-ballot-check"></span>
									<span class="menu-text">Đơn Hàng</span>
								</a>
								<ul class="menu">
									
									<li class="menu-item {{ (request()->is('admin/order/pending')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.order.pending') }}" class="menu-link"><i class="fas fa-pennant"></i> Chờ Duyệt</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/order/approved')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.order.approved') }}" class="menu-link"><i class="fas fa-clipboard-check"></i> Đã Duyệt</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/order/success')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.order.success') }}" class="menu-link"><i class="fas fa-walking"></i> Hoàn Thành</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/order/cancel')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.order.cancel') }}" class="menu-link"><i class="fas fa-times"></i> Hủy Đơn</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/order/all')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.order') }}" class="menu-link"><i class="fas fa-list"></i> Tất Cả</a>
									</li>
								</ul>
							</li>
							<li class="menu-item has-child {{ (request()->is('admin/statistical*')) ? 'has-open' : '' }}">
								<a href="#" class="menu-link">
									<span class="menu-icon oi oi-bar-chart"></span>
									<span class="menu-text">Thống Kê</span>
								</a>
								<ul class="menu">
									<li class="menu-item {{ (request()->is('admin/statistical/basic*')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.statistical.basic_today') }}" class="menu-link"><i class="far fa-chart-bar"></i> Cơ Bản</a>
									</li>
									<li class="menu-item {{ (request()->is('admin/statistical/advance*')) ? 'has-active' : '' }}">
										<a href="{{ route('backend.statistical.advance') }}" class="menu-link"><i class="fas fa-analytics"></i> Nâng Cao</a>
									</li>
								</ul>
							</li>
							<li class="menu-item {{ (request()->is('admin/fellback*')) ? 'has-active' : '' }}">
								<a href="{{ route('backend.fellback') }}" class="menu-link">
									<span class="menu-icon fas fa-rocket"></span>
									<span class="menu-text">Phản Hồi</span>
								</a>
							</li>

							<li class="menu-header">Thiết Lập</li>
							<li class="menu-item has-child {{ request()->is('admin/basic*') ? 'has-open' : '' }}">
								<a href="#" class="menu-link">
									<span class="menu-icon oi oi-puzzle-piece"></span>
									<span class="menu-text">Cơ Bản</span>
								</a>
								<ul class="menu">
									<li class="menu-item {{ request()->is('admin/basic/banner') ? 'has-active' : '' }}">
										<a href="{{ route('backend.banner') }}" class="menu-link"><i class="fas fa-pennant"></i> Ảnh Bìa</a>
									</li>
								</ul>
							</li>
							<li class="menu-item has-child {{ request()->is('admin/policy-term*') ? 'has-open' : '' }}">
								<a href="#" class="menu-link">
									<span class="menu-icon fab fa-old-republic"></span>
									<span class="menu-text">Chính Sách & Điều Khoản</span>
								</a>
								<ul class="menu">
									<li class="menu-item {{ request()->is('admin/policy-term/policy') ? 'has-active' : '' }}">
										<a href="{{ route('backend.policy') }}" class="menu-link"><i class="fas fa-handshake"></i> Chính Sách</a>
									</li>
									<li class="menu-item {{ request()->is('admin/policy-term/term') ? 'has-active' : '' }}">
										<a href="{{ route('backend.term') }}" class="menu-link"><i class="fas fa-gavel"></i> Điều Khoản</a>
									</li>
								</ul>
							</li>
							<li class="menu-item has-child">
								<a href="#" class="menu-link">
									<span class="menu-icon oi oi oi-wrench"></span>
									<span class="menu-text">Nâng Cao</span>
								</a>
								<ul class="menu">
									<li class="menu-item">
										<a href="http://localhost/phpmyadmin/db_structure.php?server=1&db=db_shofixstore_final_v9" class="menu-link" target="_blank"><i class="fas fa-database"></i> DataBase</a>
									</li>
								</ul>
							</li>

						</ul>
					</nav>
				</div>
				<footer class="aside-footer border-top p-2">
					<p class="text-light text-center">
						v17.9.2 @Trần Minh Tâm
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
						<a class="text-muted" href="#">Chính Sách</a>
					</li>
					<li class="list-inline-item">
						<a class="text-muted" href="#">Điều Khoản</a>
					</li>
				</ul>
				<div class="copyright">Copyright © @php echo date('Y') @endphp. All right reserved.</div>
			</footer>
		</main>
	</div>

	<div class="toast" style="position: absolute; top: 5%; right: 0;" data-delay="3000">
		<div class="toast-header">
			<strong class="mr-auto">Thông Báo!</strong>
			<small>1 giây trước</small>
			<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div id="my-msg" class="toast-body">
			This is message
		</div>
	</div>

	<script src="{{ asset('public/js/jquery-3.5.1.min.js') }}"></script>
	<!-- <script src="{{ asset('public/js/jquery.timeago.js') }}"></script> -->
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
	<script src="{{ asset('public/js/ckeditor/ckeditor.js') }}"></script>
	<script src="{{ asset('public/js/main.js') }}"></script>
	<script src="{{ asset('public/js/app.js') }}"></script>

	<script src="{{ asset('public/backend/js/jquery.dataTables.min.js') }}"></script>
	<!-- <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script> -->

	<script src="{{ asset('public/js/croppie.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.js"></script>

	<script>
		define(["path/to/de"], function(en) {
			$(".select2").select2({
				language: en
			});
		});
	</script>

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