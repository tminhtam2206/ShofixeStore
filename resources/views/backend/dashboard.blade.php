@extends('layouts.backend')
@section('title', 'Bảng Điều Khiển')
@section('content')
<div class="page-inner">
    <header class="page-title-bar">
        <div class="d-flex flex-column flex-md-row">
            <p class="lead">
                <span class="font-weight-bold text-uppercase">Xin chào, {{ Auth::user()->name }}.</span>
                <span class="d-block text-muted text-uppercase">Đây là những gì đang xảy ra với cửa hàng của bạn ngày hôm nay.</span>
            </p>
            <div class="ml-auto">
                <input type="text" class="form-control" data-toggle="flatpickr" value="{{ date('Y-m-d') }}" data-enable-time="true" data-date-format="Y-m-d">
            </div>
        </div>
    </header>

    <div class="page-section">
        <div class="section-block">
            <div class="metric-row">
                <div class="col-lg-9">
                    <div class="metric-row metric-flush">
                        <div class="col">
                            <a href="{{ route('backend.user.all') }}" class="metric metric-bordered align-items-center">
                                <h2 class="metric-label">TẤT CẢ NGƯỜI DÙNG</h2>
                                <p class="metric-value h3">
                                    <sub><i class="oi oi-people"></i></sub><span class="value"> {{ $user_count }}</span>
                                </p>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('backend.product') }}" class="metric metric-bordered align-items-center">
                                <h2 class="metric-label">TẤT CẢ SẢN PHẨM</h2>
                                <p class="metric-value h3">
                                    <sub><i class="fab fa-product-hunt"></i></sub><span class="value"> {{ $product_count }}</span>
                                </p>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('backend.order') }}" class="metric metric-bordered align-items-center">
                                <h2 class="metric-label">TẤT CẢ ĐƠN HÀNG</h2>
                                <p class="metric-value h3">
                                    <sub><i class="fa fa-tasks"></i></sub><span class="value"> {{ $order_count }}</span>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <a href="{{ route('backend.order.pending') }}" class="metric metric-bordered">
                        <div class="metric-badge text-center">
                            <span class="badge badge-lg badge-success"><span class="oi oi-media-record pulse mr-1"></span> ĐƠN HÀNG CHỜ DUYỆT</span>
                        </div>
                        <p class="metric-value h3 text-center">
                            <sub><i class="oi oi-timer"></i></sub><span class="value"> {{ $order_wait_count }}</span>
                        </p>
                    </a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-lg-12 col-xl-4">
                <div class="card card-fluid" style="height: 389px;">
                    <div class="card-body">
                        <h3 class="card-title mb-4 text-center" style="border-bottom: 1px solid;">ĐƠN HÀNG GẦN ĐÂY</h3>
                        <div class="chartjs" style="height: 292px">
                            <canvas id="completion-tasks"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 col-xl-4">
                <div class="card card-fluid" style="height: 389px;">
                    <div class="card-body">
                        <h3 class="card-title text-center" style="border-bottom: 1px solid;">XỬ LÝ ĐƠN HÀNG TRONG NGÀY ({{ $order_today }})</h3>
                        <div class="text-center pt-3">
                            <div class="chart-inline-group" style="height:214px">
                                <div class="easypiechart" data-toggle="easypiechart" data-percent="{{ $order_wait_process }}" data-size="214" data-bar-color="#346CB0" data-track-color="false" data-scale-color="false" data-rotate="225"></div>
                                <div class="easypiechart" data-toggle="easypiechart" data-percent="{{ $order_cancel_process }}" data-size="174" data-bar-color="#00A28A" data-track-color="false" data-scale-color="false" data-rotate="225"></div>
                                <div class="easypiechart" data-toggle="easypiechart" data-percent="{{ $order_complete_process }}" data-size="134" data-bar-color="#5F4B8B" data-track-color="false" data-scale-color="false" data-rotate="225"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="card-footer-item">
                            <i class="fa fa-fw fa-circle text-indigo"></i> {{ $order_wait_process }}% <div class="text-muted small">Chờ Duyệt</div>
                        </div>
                        <div class="card-footer-item">
                            <i class="fa fa-fw fa-circle text-purple"></i> {{ $order_complete_process }}% <div class="text-muted small">Hoàn Thành</div>
                        </div>
                        <div class="card-footer-item">
                            <i class="fa fa-fw fa-circle text-teal"></i> {{ $order_cancel_process }}% <div class="text-muted small">Bị Hủy</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 col-xl-4">
                <div class="card card-fluid">
                    <div class="card-body pb-0">
                        <h3 class="card-title text-center" style="border-bottom: 1px solid;">THỐNG KÊ NGƯỜI DÙNG ({{ $user_count }})</h3>
                        <ul class="list-inline small">
                            <li class="list-inline-item">
                                <i class="fa fa-fw fa-circle text-purple"></i> Hoạt động
                            </li>
                            <li class="list-inline-item">
                                <i class="fa fa-fw fa-circle text-teal"></i> Bị Khóa
                            </li>
                            <li class="list-inline-item">
                                <i class="fa fa-fw fa-circle text-warning"></i> Staff
                            </li>
                            <li class="list-inline-item">
                                <i class="fa fa-fw fa-circle text-red"></i> Admin
                            </li>
                        </ul>
                    </div>
                    <div class="list-group list-group-flush">
                        <!-- user active -->
                        <div class="list-group-item">
                            <div class="list-group-item-figure">
                                <a href="{{ route('backend.user.active') }}" class="tile tile-md bg-purple" data-toggle="tooltip" title="Tài khoản hoạt động"><i class="fas fa-user-check"></i></a>
                            </div>
                            <div class="list-group-item-body">
                                <div class="progress progress-animated bg-transparent rounded-0" data-toggle="tooltip" data-html="true" title='&lt;div class="text-left small"&gt;&lt;i class="fa fa-fw fa-circle text-purple"&gt;&lt;/i&gt; {{ $count_active }} tài khoản&lt;br&gt;</div>'>
                                    <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="{{ (round(($count_active/$user_count) * 100)) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ (round(($count_active/$user_count) * 100)) }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- user lock teal -->
                        <div class="list-group-item">
                            <div class="list-group-item-figure">
                                <a href="{{ route('backend.user.lock') }}" class="tile tile-md bg-teal" data-toggle="tooltip" title="Tài khoản bị khóa"><i class="fas fa-user-lock"></i></a>
                            </div>
                            <div class="list-group-item-body">
                                <div class="progress progress-animated bg-transparent rounded-0" data-toggle="tooltip" data-html="true" title='&lt;div class="text-left small"&gt;&lt;i class="fa fa-fw fa-circle text-teal"&gt;&lt;/i&gt; {{ $count_lock }} tài khoản&lt;br&gt;</div>'>
                                    <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="{{ (round(($count_lock/$user_count) * 100)) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ (round(($count_lock/$user_count) * 100)) }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- user staff info -->
                        <div class="list-group-item">
                            <div class="list-group-item-figure">
                                <a href="{{ route('backend.user.all') }}" class="tile tile-md bg-info" data-toggle="tooltip" title="Tài khoản nhân viên"><i class="fas fa-user-shield"></i></a>
                            </div>
                            <div class="list-group-item-body">
                                <div class="progress progress-animated bg-transparent rounded-0" data-toggle="tooltip" data-html="true" title='&lt;div class="text-left small"&gt;&lt;i class="fa fa-fw fa-circle text-info"&gt;&lt;/i&gt; {{ $count_staff }} tài khoản&lt;br&gt;</div>'>
                                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="{{ (round(($count_staff/$user_count) * 100)) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ (round(($count_staff/$user_count) * 100)) }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- user admin -->
                        <div class="list-group-item">
                            <div class="list-group-item-figure">
                                <a href="{{ route('backend.user.all') }}" class="tile tile-md bg-red" data-toggle="tooltip" title="Tài khoản admin"><i class="fas fa-users-cog"></i></a>
                            </div>
                            <div class="list-group-item-body">
                                <div class="progress progress-animated bg-transparent rounded-0" data-toggle="tooltip" data-html="true" title='&lt;div class="text-left small"&gt;&lt;i class="fa fa-fw fa-circle text-red"&gt;&lt;/i&gt; {{ $count_admin }} tài khoản&lt;br&gt;</div>'>
                                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="{{ (round(($count_admin/$user_count) * 100)) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ (round(($count_admin/$user_count) * 100)) }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- all user -->
                        <div class="list-group-item">
                            <div class="list-group-item-figure">
                                <a href="{{ route('backend.user.all') }}" class="tile tile-md bg-warning" data-toggle="tooltip" title="Tất cả tài khoản"><i class="fas fa-users"></i></a>
                            </div>
                            <div class="list-group-item-body">
                                <div class="progress progress-animated bg-transparent rounded-0" data-toggle="tooltip" data-html="true" title='&lt;div class="text-left small"&gt;&lt;i class="fa fa-fw fa-circle text-warning"&gt;&lt;/i&gt; {{ $user_count }} tài khoản&lt;br&gt;</div>'>
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-deck-xl">
            <div class="card card-fluid pb-3">
                <div class="card-header bg-success text-light">HOẠT ĐỘNG GẦN ĐÂY</div>
                <div class="lits-group list-group-flush">
                    @foreach($load_record as $value)
                    <div class="list-group-item">
                        <div class="list-group-item-figure">
                            <div class="has-badge">
                                <a href="#" class="tile tile-md bg-purple"><i class="fas fa-calendar-alt"></i></a>
                                <a href="#" class="user-avatar user-avatar-xs" style="border: none;"></a>
                            </div>
                        </div>
                        <div class="list-group-item-body">
                            <h5 class="card-title">
                                <a href="#">{{ $value->action }}</a>
                            </h5>
                            <p class="card-subtitle text-muted mb-1">{{ $value->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card card-fluid">
                <div class="card-header bg-success text-light">PHẢN HỒI TỪ NGƯỜI DÙNG</div>
                <div class="card-body">
                    <!-- start loop -->
                    <div class="lits-group list-group-flush">
                    @foreach($fellback as $value)
                    <div class="list-group-item">
                        <div class="list-group-item-figure">
                            <div class="has-badge">
                                <a href="#" class="tile tile-md bg-purple"><i class="fas fa-comment-alt-dots"></i></a>
                                <a href="#" class="user-avatar user-avatar-xs" style="border: none;"></a>
                            </div>
                        </div>
                        <div class="list-group-item-body">
                            <h5 class="card-title">
                                <a href="#">{{ $value->email }}</a>
                            </h5>
                            <p class="card-subtitle text-muted mb-1">{{ $value->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                    <!-- end loop -->
                </div>
                <div class="card-footer">
                    <a href="{{ route('backend.fellback') }}" class="card-footer-item">Xem tất cả <i class="fa fa-fw fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    $(function() {
        $("#my-datepicker").datepicker();
    });
</script>

<script>
"use strict";
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }
// Dashboard Demo
// =============================================================
var DashboardDemo =
  /*#__PURE__*/
  function () {
    function DashboardDemo() {
      _classCallCheck(this, DashboardDemo);
      this.init();
    }

    _createClass(DashboardDemo, [{
      key: "init",
      value: function init() {
        // event handlers
        this.completionTasksChart();
      }
    }, {
      key: "completionTasksChart",
      value: function completionTasksChart() {
        var data = {
          labels: [@php echo($recent_order_product['string_date']); @endphp],
          datasets: [{
            backgroundColor: Looper.getColors('brand').indigo,
            borderColor: Looper.getColors('brand').indigo,
            data: [{{ $recent_order_product['data_product'] }}]
          }] // init chart bar
        };
        var canvas = $('#completion-tasks')[0].getContext('2d');
        var chart = new Chart(canvas, {
          type: 'bar',
          data: data,
          options: {
            responsive: true,
            legend: {
              display: false
            },
            title: {
              display: false
            },
            scales: {
              xAxes: [{
                gridLines: {
                  display: true,
                  drawBorder: false,
                  drawOnChartArea: false
                },
                ticks: {
                  maxRotation: 0,
                  maxTicksLimit: 3
                }
              }],
              yAxes: [{
                gridLines: {
                  display: true,
                  drawBorder: false
                },
                ticks: {
                  beginAtZero: true,
                  stepSize: 100
                }
              }]
            }
          }
        });
      }
    }]);
    return DashboardDemo;
  }();
/**
 * Keep in mind that your scripts may not always be executed after the theme is completely ready,
 * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
 */
$(document).on('theme:init', function () {
  new DashboardDemo();
});
</script>
@endsection