@if($banner == null)
<div class="banner-image-wrap overlay">
    <img src="{{ asset('public/banner/default.jpg') }}"/>
    <div class="banner-content static-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="nivo_text">
                        <div class="nivo_text-wrapper">
                            <div class="slider-content slider-text-1 text-left">
                                <h2 style="color: white;">BỘ SƯU TẬP ĐỘC QUYỀN </h2>
                            </div>
                            <div class="slider-content slider-text-2 text-left hidden-xs">
                                <h1 class="cd-headline push">
                                    <span style="color: white;">THỜI TRANG CHO </span>
                                    <span class="cd-words-wrapper">
                                        <b style="color: white;" class="is-visible text-uppercase">NAM GIỚI</b>
                                        <b style="color: white;" class="text-uppercase">PHỤ NỮ</b>
                                        <b style="color: white;" class="text-uppercase">TRẺ EM</b>
                                        <b style="color: white;" class="text-uppercase">THIẾU NIÊN</b>
                                    </span>
                                </h1>
                            </div>
                            <div class="slider-content slider-text-4 text-left hidden-sm hidden-xs">
                                <a href='#' class='slider-button'>MUA SẮM NGAY</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="banner-image-wrap overlay">
    <img src="{{ asset('public/banner').'/'.$banner->image }}" />
    <div class="banner-content static-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="nivo_text">
                        <div class="nivo_text-wrapper">
                            <div class="slider-content slider-text-1 text-left">
                                <h2>BỘ SƯU TẬP ĐỘC QUYỀN </h2>
                            </div>
                            <div class="slider-content slider-text-2 text-left hidden-xs">
                                <h1 class="cd-headline push">
                                    <span>ÁO DÀI CHO </span>
                                    <span class="cd-words-wrapper">
                                        <b class="is-visible text-uppercase">NAM</b>
                                        <b class="text-uppercase">NỮ</b>
                                        <b class="text-uppercase">TRẺ EM</b>
                                        <b class="text-uppercase">CAO CẤP</b>
                                    </span>
                                </h1>
                            </div>
                            <div class="slider-content slider-text-4 text-left hidden-sm hidden-xs">
                                <a href='#' class='slider-button'>MUA SẮM NGAY</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif