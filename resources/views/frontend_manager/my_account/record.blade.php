@extends('frontend_manager.my_account.profile')
@section('title', 'Nhật Ký Hoạt Động')
@section('child-content')
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
    <div class="section-block">
        <h2 class="section-title">Hôm Nay</h2>
        <ul class="timeline">
            @foreach($today as $value)
            <li class="timeline-item">
                <div class="timeline-figure">
                    <span class="tile tile-circle tile-sm">
                        <i class="fas fa-circle"></i>
                    </span>
                </div>
                <div class="timeline-body">
                    <div class="media">
                        <div class="media-body">
                            <h6 class="timeline-heading">
                                <span class="text-primary">{{ $value->action }}</span>
                            </h6>
                            <p class="timeline-date d-sm-none">
                            {{ $value->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <span class="timeline-date">
                            {{ $value->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        <h2 class="section-title">Ngày Hôm Qua</h2>
        <ul class="timeline">
            @foreach($yesterday as $value)
            <li class="timeline-item">
                <div class="timeline-figure">
                    <span class="tile tile-circle tile-sm">
                        <i class="far fa-circle"></i>
                    </span>
                </div>
                <div class="timeline-body">
                    <div class="media">
                        <div class="media-body">
                            <h6 class="timeline-heading">
                                <span class="text-primary">{{ $value->action }}</span>
                            </h6>
                            <p class="timeline-date d-sm-none">
                                {{ $value->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <span class="timeline-date">
                                {{ $value->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        <h2 class="section-title">2 Ngày Trước</h2>
        <ul class="timeline">
            @foreach($two_day_ago as $value)
            <li class="timeline-item">
                <div class="timeline-figure">
                    <span class="tile tile-circle tile-sm">
                        <i class="fas fa-dot-circle"></i>
                    </span>
                </div>
                <div class="timeline-body">
                    <div class="media">
                        <div class="media-body">
                            <h6 class="timeline-heading">
                                <span class="text-primary">{{ $value->action }}</span>
                            </h6>
                            <p class="timeline-date d-sm-none">
                                {{ $value->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <span class="timeline-date">
                                {{ $value->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <p class="text-center">
        <button type="button" class="btn btn-light"><i class="fa fa-fw fa-angle-double-down"></i> Xem Thêm</button>
    </p>
</div>
@endsection