@extends('layouts.frontend')
@section('title', 'Trang Chủ')
@section('content')
<!-- slider bottom start -->
<div class="slider-bottom-area mt-10 text-left">
    <div class="container-fluid">
        <div class="row">
            <!-- start loop -->
            @foreach($hot as $value)
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-slider-bottom">
                    <div class="single-slider-bottom-img">
                        <a href="{{ route('frontend.product_detail', ['name_slug' => $value->name_slug, 'id' => $value->id]) }}"><img src="{{ asset('public/images/banner/1.jpg') }}" alt="product"></a>
                    </div>
                    <div class="single-slider-info">
                        <h4 class="text-uppercase" style="color:white; text-shadow: 1px 1px 2px #111;">{{ $value->name }}</h4>
                        <!-- <h2 class="text-uppercase">bag’s</h2> -->
                        <h4 class="text-uppercase" style="color:gold; text-shadow: 1px 1px 2px #111;">{{ disCount($value->discount, $value->price) }}</h4>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- end loop -->
        </div>
    </div>
</div>
<!--slider bottom end -->
<!-- arrival start-->
<div class="arrival-area clearfix pt-90">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-tab">
                    <div class="section-tab-menu text-center mb-45">
                        <ul role="tablist">
                            <li role="presentation" class="active text-uppercase"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">Sản Phẩm Mới</a></li>
                            <li role="presentation" class="text-uppercase"><a href="#featured" aria-controls="featured" role="tab" data-toggle="tab">Đặc Sắc</a></li>
                            <li role="presentation" class="text-uppercase"><a href="#best" aria-controls="best" role="tab" data-toggle="tab">Bán CHạy</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <div class="tab-content row">
                        <!-- new product -->
                        <div id="new" role="tabpanel" class="active section-tab-item">
                            <div class="tab-item-slider">
                                <!-- start loop new product -->
                               @foreach($new_product as $value)
                                <div class="col-xs-12 col-width">
                                    <div class="single-product">
                                        <div class="single-product-item clearfix">
                                            <div class="single-product-img clearfix">
                                                <a href="{{ route('frontend.product_detail', ['name_slug' => $value->name_slug, 'id' => $value->id]) }}">
                                                    <img class="primary-image" src="{{ firstProductImage($value->image) }}" alt="product">
                                                </a>
                                                <div class="wish-icon-hover text-center clearfix">
                                                    <div class="hover-text">
                                                        <p>{{ $value->summary }}</p>
                                                        <ul>
                                                            <li>
                                                                <span data-toggle="Thêm vào giỏ hàng" title="Thêm vào giỏ hàng" onclick="add_to_cart('{{ $value->id }}')">
                                                                    <i class="fas fa-cart-plus"></i>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="modal-view" data-view-id="{{ $value->id }}">
                                                                    <i class="fa fa-eye"></i>
                                                                </span>
                                                            </li>
                                                            <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                            @foreach($my_favourite as $val_favourite)
                                                            @if($value->id == $val_favourite->product_id)
                                                            <li><span data-toggle="tooltip" title="Yêu thích"><i id="favourite-{{ $value->id }}" class="btn-add-favourite fa fa-heart" data-product-id="{{ $value->id }}" data-user-id="{{ Auth::id() }}"></i></span></li>
                                                            @else
                                                            <li><span data-toggle="tooltip" title="Yêu thích"><i id="favourite-{{ $value->id }}" class="btn-add-favourite far fa-heart" data-product-id="{{ $value->id }}" data-user-id="{{ Auth::id() }}"></i></span></li>
                                                            @endif
                                                            @endforeach
                                                            @if(count($my_favourite) == 0)
                                                            <li><span data-toggle="tooltip" title="Yêu thích"><i id="favourite-{{ $value->id }}" class="btn-add-favourite far fa-heart" data-product-id="{{ $value->id }}" data-user-id="{{ Auth::id() }}"></i></span></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-product-info clearfix">
                                                <div class="pro-rating">
                                                @for($i = 1; $i<= 5; $i++)
                                                @if($i <= $value->marks)
                                                <i class="fa fa-star" style="color: gold;"></i>
                                                @else
                                                <i class="far fa-star" style="color: gold;"></i>
                                                @endif
                                                @endfor
                                                </div>
                                                <div class="pro-price">
                                                    @if($value->discount > 0)
                                                    <span class="new-price">{{ disCount($value->discount, $value->price) }}</span>
                                                    <span class="old-price">{{ number_format($value->price) }}</span>
                                                    @else
                                                    <span class="new-price">{{ disCount($value->discount, $value->price) }}</span>
                                                    @endif
                                                </div>
                                                <h3><a href="{{ route('frontend.product_detail', ['name_slug' => $value->name_slug, 'id' => $value->id]) }}">{{ $value->name }}</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- end loop new product -->
                            </div>
                        </div>
                        <!-- end new product -->

                        <!-- featured product -->
                        <div id="featured" role="tabpanel" class="section-tab-item">
                            <div class="tab-item-slider">
                                <!-- start loop -->
                                @foreach($featured as $value)
                                <div class="col-xs-12 col-width">
                                    <div class="single-product">
                                        <div class="single-product-item">
                                            <div class="single-product-img clearfix hover-effect">
                                                <a href="{{ route('frontend.product_detail', ['name_slug' => $value->name_slug, 'id' => $value->id]) }}">
                                                    <img class="primary-image" src="{{ firstProductImage($value->image) }}" alt="">
                                                </a>
                                                <div class="wish-icon-hover text-center clearfix">
                                                    <div class="hover-text">
                                                        <p>{{ $value->summary }}</p>
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                            <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                            <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-product-info clearfix">
                                                <div class="pro-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="pro-price">
                                                    @if($value->discount > 0)
                                                    <span class="new-price">{{ disCount($value->discount, $value->price) }}</span>
                                                    <span class="old-price">{{ number_format($value->price) }}</span>
                                                    @else
                                                    <span class="new-price">{{ disCount($value->discount, $value->price) }}</span>
                                                    @endif
                                                </div>
                                                <h3><a href="{{ route('frontend.product_detail', ['name_slug' => $value->name_slug, 'id' => $value->id]) }}">{{ $value->name }}</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- end loop -->
                            </div>
                        </div>
                        <!-- end featured product -->

                        <!-- best product -->
                        <div id="best" role="tabpanel" class="section-tab-item">
                            <div class="tab-item-slider">
                                <!-- start loop -->
                                @foreach($best as $value)
                                <div class="col-xs-12 col-width">
                                    <div class="single-product">
                                        <div class="single-product-item">
                                            <div class="single-product-img clearfix hover-effect">
                                                <a href="#">
                                                    <img class="primary-image" src="{{ firstProductImage($value->image) }}" alt="">
                                                </a>
                                                <div class="wish-icon-hover text-center clearfix">
                                                    <div class="hover-text">
                                                        <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat </p>
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                            <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                            <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-product-info clearfix">
                                                <div class="pro-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="pro-price">
                                                    @if($value->discount == 0)
                                                    <span class="new-price">{{ disCount($value->discount, $value->price) }}</span>
                                                    @else
                                                    <span class="old-price">{{ number_format($value->price) }}</span>
                                                    @endif
                                                </div>
                                                <h3><a href="#">{{ $value->name }}</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- end loop -->
                            </div>
                        </div>
                        <!-- end best product -->
                    </div>
                </div>
                <div class="arrival-button text-center mt-30">
                    <a href='#' class='section-button'>Xem Thêm</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- arrival end -->
<!-- featured start -->
<div class="featured-area ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-tab">
                    <div class="section-tab-menu mb-45 text-center">
                        <ul role="tablist">
                            <li role="presentation" class="active text-uppercase"><a href="#featured1" aria-controls="featured1" role="tab" data-toggle="tab">Mới Nhập</a></li>
                            <li role="presentation" class="text-uppercase"><a href="#trendy" aria-controls="trendy" role="tab" data-toggle="tab">Xu Hướng</a></li>
                            <li role="presentation" class="text-uppercase"><a href="#best1" aria-controls="best1" role="tab" data-toggle="tab">Best Selling</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start thumb-lg -->
            @foreach($featured as $value)
            <div class="col-md-5 hidden-sm hidden-xs">
                <div class="featured-left mt-2">
                    <a href="#">
                        <img src="{{ firstProductThum_LG($value->image) }}" alt="">
                    </a>
                    <span class="red hidden-sm" style="margin-left: 35px">hot</span>
                </div>
                <div class="single-product-info clearfix">
                    <div class="pro-title">
                        <h3><a href="#">{{ $value->name }}</a></h3>
                    </div>
                    <div class="pro-price">
                        <span class="new-price">$150</span>
                        <span class="old-price">$180</span>
                    </div>
                </div>
            </div>
            @break;
            @endforeach
            <!-- end thumb-lg -->
            <div class="col-md-7">
                <div class="clearfix"></div>
                <div class="tab-content row">
                    <!-- start featured1 -->
                    <div id="featured1" role="tabpanel" class="active section-tab-item">
                        <div class="feature-slider">
                            <!-- start loop product -->
                            @foreach($featured as $value)
                            <div class="col-xs-12 col-width">
                                <div class="single-product">
                                    <div class="single-product-item clearfix">
                                        <div class="single-product-img clearfix">
                                            <a href="#">
                                                <img class="primary-image" src="{{ firstProductImage($value->image) }}" alt="product">
                                            </a>
                                            <div class="wish-icon-hover text-center clearfix">
                                                <div class="hover-text">
                                                    <p class="hidden-md">Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat </p>
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                        <li class="hidden-md"><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-product-info clearfix">
                                            <div class="pro-title">
                                                <h3><a href="#">{{ $value->name }}</a></h3>
                                            </div>
                                            <div class="pro-price">
                                                <span class="new-price">$150</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="black hidden-sm">new</span>
                                </div>
                                <div class="single-product">
                                    <div class="single-product-item clearfix">
                                        <div class="single-product-img clearfix">
                                            <a href="#">
                                                <img class="primary-image" src="{{ firstProductImage($value->image) }}" alt="product">
                                            </a>
                                            <div class="wish-icon-hover text-center clearfix">
                                                <div class="hover-text">
                                                    <p class="hidden-md">Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat </p>
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                        <li class="hidden-md"><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-product-info clearfix">
                                            <div class="pro-title">
                                                <h3><a href="#">{{ $value->name }}</a></h3>
                                            </div>
                                            <div class="pro-price">
                                                <span class="new-price">$150</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="red hidden-sm">hot</span>
                                </div>
                            </div>
                            @endforeach
                            <!-- end loop product -->
                        </div>
                    </div>
                    <!-- end featured1 -->

                    <div id="trendy" role="tabpanel" class="section-tab-item">
                        <div class="feature-slider">
                            <!-- start loop -->
                            <div class="col-xs-12 col-width">
                                <div class="single-product">
                                    <div class="single-product-item clearfix">
                                        <div class="single-product-img clearfix">
                                            <a href="#">
                                                <img class="primary-image" src="{{ asset('public/frontend/img/product/8.jpg') }}" alt="product">
                                            </a>
                                            <div class="wish-icon-hover text-center clearfix">
                                                <div class="hover-text">
                                                    <p class="hidden-md">Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat </p>
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                        <li class="hidden-md"><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-product-info clearfix">
                                            <div class="pro-title">
                                                <h3><a href="#">Electria Ostma</a></h3>
                                            </div>
                                            <div class="pro-price">
                                                <span class="new-price">$150</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="black hidden-sm">new</span>
                                </div>
                                <div class="single-product">
                                    <div class="single-product-item clearfix">
                                        <div class="single-product-img clearfix">
                                            <a href="#">
                                                <img class="primary-image" src="{{ asset('public/frontend/img/product/6.jpg') }}" alt="product">
                                            </a>
                                            <div class="wish-icon-hover text-center clearfix">
                                                <div class="hover-text">
                                                    <p class="hidden-md">Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat </p>
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                        <li class="hidden-md"><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-product-info clearfix">
                                            <div class="pro-title">
                                                <h3><a href="#">Electria Ostma</a></h3>
                                            </div>
                                            <div class="pro-price">
                                                <span class="new-price">$150</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="red hidden-sm">hot</span>
                                </div>
                            </div>
                            <!-- end loop -->
                        </div>
                    </div>
                    <div id="best1" role="tabpanel" class="section-tab-item">
                        <div class="feature-slider">
                            <!-- start loop -->
                            <div class="col-xs-12 col-width">
                                <div class="single-product">
                                    <div class="single-product-item clearfix">
                                        <div class="single-product-img clearfix">
                                            <a href="#">
                                                <img class="primary-image" src="{{ asset('public/frontend/img/product/8.jpg') }}" alt="product">
                                            </a>
                                            <div class="wish-icon-hover text-center clearfix">
                                                <div class="hover-text">
                                                    <p class="hidden-md">Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat </p>
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                        <li class="hidden-md"><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-product-info clearfix">
                                            <div class="pro-title">
                                                <h3><a href="#">Electria Ostma</a></h3>
                                            </div>
                                            <div class="pro-price">
                                                <span class="new-price">$150</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="green hidden-sm">sale</span>
                                </div>
                                <div class="single-product">
                                    <div class="single-product-item clearfix">
                                        <div class="single-product-img clearfix">
                                            <a href="#">
                                                <img class="primary-image" src="{{ asset('public/frontend/img/product/11.jpg') }}" alt="product">
                                            </a>
                                            <div class="wish-icon-hover text-center clearfix">
                                                <div class="hover-text">
                                                    <p class="hidden-md">Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat </p>
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                        <li class="hidden-md"><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-product-info clearfix">
                                            <div class="pro-title">
                                                <h3><a href="#">Electria Ostma</a></h3>
                                            </div>
                                            <div class="pro-price">
                                                <span class="new-price">$150</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="black hidden-sm">new</span>
                                </div>
                            </div>
                            <!-- end loop -->
                        </div>
                    </div>
                </div>
                <div class="arrival-button text-left">
                    <a href='#' class='section-button mt-30'>Xem Thêm</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- featured end -->
<!-- off banner area start -->
<div class="off-banner-area">
    <div class="container-fluid">
        <div class="row">
            <div class="single-off-banner text-left">
                <div class="off-img">
                    <a href="#">
                        <img src="{{ asset('public/frontend/img/off-banner/1.jpg') }}" alt="">
                    </a>
                </div>
                <div class="off-text">
                    <h4 class="text-uppercase">GET 25% OFF</h4>
                    <h2 class="text-uppercase">MEN’S </h2>
                    <h4 class="text-uppercase">COLLECTION </h4>
                    <a href="#" class="section-button">shop now</a>
                </div>
            </div>
            <div class="single-off-banner text-center">
                <div class="off-img">
                    <a href="#">
                        <img src="{{ asset('public/frontend/img/off-banner/2.jpg') }}" alt="">
                    </a>
                </div>
                <div class="off-text">
                    <h3 class="text-uppercase">EXCLUSIVE </h3>
                    <h2 class="text-uppercase">MEN’S &amp; WOMEN's</h2>
                    <h3 class="text-uppercase">COLLECTION </h3>
                    <a href="#" class="section-button">shop now</a>
                </div>
            </div>
            <div class="single-off-banner text-left">
                <div class="off-img">
                    <a href="#">
                        <img src="{{ asset('public/frontend/img/off-banner/3.jpg') }}" alt="">
                    </a>
                </div>
                <div class="off-text">
                    <h4 class="text-uppercase">GET 25% OFF</h4>
                    <h2 class="text-uppercase">WOMEN’S </h2>
                    <h4 class="text-uppercase">COLLECTION </h4>
                    <a href="#" class="section-button">shop now</a>
                </div>
            </div>
        </div>
    </div>
    <div class="consultation-angle"></div>
</div>
<!-- off banner area end -->
<!-- women area start -->
<div class="women-area ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-tab">
                    <div class="section-tab-menu mb-45 text-center">
                        <ul role="tablist">
                            <li role="presentation" class="active text-uppercase"><a href="#dress" aria-controls="dress" role="tab" data-toggle="tab">Trang Phục</a></li>
                            <li role="presentation" class="text-uppercase"><a href="#tops" aria-controls="tops" role="tab" data-toggle="tab">tops</a></li>
                            <li role="presentation" class="text-uppercase"><a href="#handbags" aria-controls="handbags" role="tab" data-toggle="tab">Túi Xách</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="clearfix"></div>
                <div class="tab-content row">
                    <div id="dress" role="tabpanel" class="active section-tab-item">
                        <div class="feature-slider">
                            <!-- start loop -->
                            @foreach($featured as $value)
                            <div class="col-xs-12 col-width">
                                <div class="single-product">
                                    <div class="single-product-item clearfix">
                                        <div class="single-product-img clearfix">
                                            <a href="#">
                                                <img class="primary-image" src="{{ firstProductImage($value->image) }}" alt="">
                                            </a>
                                            <div class="wish-icon-hover text-center clearfix">
                                                <div class="hover-text">
                                                    <p class="hidden-md">{{ $value->summary }}</p>
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a class="modal-view" href="#" data-toggle="modal"><i class="fa fa-eye"></i></a></li>
                                                        <li class="hidden-md"><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-product-info clearfix">
                                            <div class="pro-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="pro-price">
                                                <span class="new-price">$150</span>
                                                <span class="old-price">$180</span>
                                            </div>
                                            <h3><a href="#">{{ $value->name }}</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- end loop -->
                        </div>
                    </div>
                    <div id="tops" role="tabpanel" class="section-tab-item">
                        <div class="feature-slider">
                            <!-- start loop -->
                            @foreach($featured as $value)
                            <div class="col-xs-12 col-width">
                                <div class="single-product">
                                    <div class="single-product-item clearfix">
                                        <div class="single-product-img clearfix">
                                            <a href="#">
                                                <img class="primary-image" src="{{ firstProductImage($value->image) }}" alt="">
                                            </a>
                                            <div class="wish-icon-hover text-center clearfix">
                                                <div class="hover-text">
                                                    <p class="hidden-md">Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat </p>
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                        <li class="hidden-md"><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-product-info clearfix">
                                            <div class="pro-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="pro-price">
                                                <span class="new-price">$150</span>
                                                <span class="old-price">$180</span>
                                            </div>
                                            <h3><a href="#">{{ $value->name }}</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- end loop -->
                        </div>
                    </div>
                    <div id="handbags" role="tabpanel" class="section-tab-item">
                        <div class="feature-slider">
                            <!-- start loop -->
                            @foreach($featured as $value)
                            <div class="col-xs-12 col-width">
                                <div class="single-product">
                                    <div class="single-product-item clearfix">
                                        <div class="single-product-img clearfix">
                                            <a href="#">
                                                <img class="primary-image" src="{{ firstProductImage($value->image) }}" alt="">
                                            </a>
                                            <div class="wish-icon-hover text-center clearfix">
                                                <div class="hover-text">
                                                    <p class="hidden-md">Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat </p>
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                        <li class="hidden-md"><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-product-info clearfix">
                                            <div class="pro-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="pro-price">
                                                <span class="new-price">$150</span>
                                                <span class="old-price">$180</span>
                                            </div>
                                            <h3><a href="#">{{ $value->name }}</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- end loop -->
                        </div>
                    </div>
                </div>
                <div class="arrival-button text-center mt-30">
                    <a href='#' class='section-button'>Xem Thêm</a>
                </div>
            </div>
            <div class="col-md-5 hidden-sm hidden-xs">
                <!-- start loop -->
                @foreach($featured as $value)
                <div class="featured-left mt-2 pull-right">
                    <a href="#">
                        <img src="{{ firstProductImage($value->image) }}" alt="">
                        <div class="feature-info text-right">
                            <h2 class="text-uppercase">women's minh-tam</h2>
                            <h3 class="text-uppercase">{{ $value->name }}</h3>
                        </div>
                    </a>
                </div>
                @break
                @endforeach
                <!-- end loop -->
            </div>
        </div>
    </div>
</div>
<!-- women area end -->
<!-- offer area start -->
<div class="offer-area ptb-130">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-5 col-xs-12">
                <div class="offer-img">
                    <img src="{{ asset('public/frontend/img/offer/1.png') }}" alt="product">
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-7 col-xs-12">
                <div class="offer-info mt-40 text-center">
                    <h3>GET IT NOW</h3>
                    <h1>LIMITED OFFER</h1>
                    <h5 class="hidden-xs">HANDBAGS COLLECTION FOR WOMEN</h5>
                </div>
                <div class="timer">
                    <div data-countdown="2017/02/01" class="timer-grid"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- offer area end -->
<!-- men area start -->
<div class="men-area ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-tab">
                    <div class="section-tab-menu mb-45 text-center">
                        <ul role="tablist">
                            <li role="presentation" class="active text-uppercase"><a href="#coats" aria-controls="coats" role="tab" data-toggle="tab">Áo Khoác</a></li>
                            <li role="presentation" class="text-uppercase"><a href="#shirts" aria-controls="shirts" role="tab" data-toggle="tab">Áo Sơ Mi</a></li>
                            <li role="presentation" class="text-uppercase"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Phụ Kiện</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 hidden-sm hidden-xs">
                <!-- start loop -->
                @foreach($featured as $value)
                <div class="featured-left mt-2">
                    <a href="#">
                        <img src="{{ firstProductImage($value->image) }}" alt="">
                        <div class="feature-info text-left">
                            <h2 class="text-uppercase">men's minh-tam</h2>
                            <h3 class="text-uppercase">collection</h3>
                        </div>
                    </a>
                </div>
                @break
                @endforeach
                <!-- end loop -->
            </div>
            <div class="col-md-7">
                <div class="clearfix"></div>
                <div class="tab-content row">
                    <div id="coats" role="tabpanel" class="active section-tab-item">
                        <div class="feature-slider">
                            <!-- start loop -->
                            <div class="col-xs-12 col-width">
                                <div class="single-product">
                                    <div class="single-product-item clearfix">
                                        <div class="single-product-img clearfix">
                                            <a href="#">
                                                <img class="primary-image" src="{{ asset('public/images/demo.jpg') }}" alt="">
                                            </a>
                                            <div class="wish-icon-hover text-center clearfix">
                                                <div class="hover-text">
                                                    <p class="hidden-md">Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat </p>
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                        <li class="hidden-md"><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-product-info clearfix">
                                            <div class="pro-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="pro-price">
                                                <span class="new-price">$150</span>
                                                <span class="old-price">$180</span>
                                            </div>
                                            <h3><a href="#">Electria Ostma</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end loop -->
                        </div>
                    </div>
                    <div id="shirts" role="tabpanel" class="section-tab-item">
                        <div class="feature-slider">
                            <!-- start loop -->
                            <div class="col-xs-12 col-width">
                                <div class="single-product">
                                    <div class="single-product-item clearfix">
                                        <div class="single-product-img clearfix">
                                            <a href="#">
                                                <img class="primary-image" src="{{ asset('public/frontend/img/product/16.jpg') }}" alt="">
                                            </a>
                                            <div class="wish-icon-hover text-center clearfix">
                                                <div class="hover-text">
                                                    <p class="hidden-md">Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat </p>
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                        <li class="hidden-md"><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-product-info clearfix">
                                            <div class="pro-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="pro-price">
                                                <span class="new-price">$150</span>
                                                <span class="old-price">$180</span>
                                            </div>
                                            <h3><a href="#">Electria Ostma</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end loop -->
                        </div>
                    </div>
                    <div id="accessories" role="tabpanel" class="section-tab-item">
                        <div class="feature-slider">
                            <!-- start loop -->
                            <div class="col-xs-12 col-width">
                                <div class="single-product">
                                    <div class="single-product-item clearfix">
                                        <div class="single-product-img clearfix">
                                            <a href="#">
                                                <img class="primary-image" src="{{ asset('public/frontend/img/product/17.jpg') }}" alt="">
                                            </a>
                                            <div class="wish-icon-hover text-center clearfix">
                                                <div class="hover-text">
                                                    <p class="hidden-md">Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat </p>
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                        <li class="hidden-md"><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-product-info clearfix">
                                            <div class="pro-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="pro-price">
                                                <span class="new-price">$150</span>
                                                <span class="old-price">$180</span>
                                            </div>
                                            <h3><a href="#">Electria Ostma</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end loop -->
                        </div>
                    </div>
                </div>
                <div class="arrival-button text-center mt-30">
                    <a href='#' class='section-button'>Xem Thêm</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- men area end -->
<!-- newsletter area start -->
<div class="newsletter-area ptb-110">
    <div class="container">
        <div class="row">
            <div class="newsletter-info">
                <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                    <div class="news-left text-right">
                        <a href="#" class="section-button">Đăng ký miễn phí</a>
                        <h3 class="text-uppercase">theo dõi bản tin</h3>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
                    <div class="news-right text-center">
                        <form action="#" id="mc-form" class="mc-form">
                            <input id="mc-email" type="text" name="email" placeholder="Địa chỉ email...">
                            <button id="mc-submit" type="submit" class="text-uppercase">Gửi</button>
                            <span class="hidden-xs"><input type="checkbox" name="agree">Bằng cách Đăng ký nhận bản tin của chúng tôi, bạn đồng ý nhận email từ chúng tôi!</span>
                        </form>
                        <!-- mailchimp-alerts Start -->
                        <div class="mailchimp-alerts text-centre fix">
                            <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                            <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                            <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                        </div>
                        <!-- mailchimp-alerts end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- newsletter area end -->
<!-- blog area start -->
<div class="blog-area ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-tab">
                    <div class="section-tab-menu mb-45 text-center">
                        <ul role="tablist">
                            <li role="presentation" class="active text-uppercase"><a href="#blog" aria-controls="blog" role="tab" data-toggle="tab">from blog</a></li>
                            <li role="presentation" class="text-uppercase"><a href="#tweet" aria-controls="tweet" role="tab" data-toggle="tab">latest tweet</a></li>
                            <li role="presentation" class="text-uppercase"><a href="#instagram" aria-controls="instagram" role="tab" data-toggle="tab">instagram</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="clearfix"></div>
            <div class="tab-content row">
                <div id="blog" role="tabpanel" class="active section-tab-item">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-blog">
                            <div class="single-blog-img">
                                <a href="#">
                                    <img src="{{ asset('public/frontend/img/blog/1.jpg') }}" alt="blog">
                                </a>
                                <div class="blog-date text-center">
                                    <h2>05 <span>Feb</span></h2>
                                </div>
                            </div>
                            <div class="single-blog-info mt-25">
                                <h4><a href="blog.html">Beautiful Collection For Beauty</a></h4>
                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was bornad will give you a complete pain was praising</p>
                                <div class="button-comments">
                                    <div class="read-button text-center">
                                        <a class="read-more text-uppercase" href="blog.html">read More <i class="fa fa-angle-double-right"></i></a>
                                    </div>
                                    <div class="comment-like">
                                        <ul>
                                            <li><i class="fa fa-comments"></i>06 comments</li>
                                            <li><i class="fa fa-heart"></i>25 likes</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-blog">
                            <div class="single-blog-img">
                                <a href="#">
                                    <img src="{{ asset('public/frontend/img/blog/2.jpg') }}" alt="blog">
                                </a>
                                <div class="blog-date text-center">
                                    <h2>09 <span>Feb</span></h2>
                                </div>
                            </div>
                            <div class="single-blog-info mt-25">
                                <h4><a href="blog.html">Fashion Show With New Trend</a></h4>
                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was bornad will give you a complete pain was praising</p>
                                <div class="button-comments">
                                    <div class="read-button text-center">
                                        <a class="read-more text-uppercase" href="blog.html">read More <i class="fa fa-angle-double-right"></i></a>
                                    </div>
                                    <div class="comment-like">
                                        <ul>
                                            <li><i class="fa fa-comments"></i>10 comments</li>
                                            <li><i class="fa fa-heart"></i>20 likes</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 hidden-sm col-xs-12">
                        <div class="single-blog-list">
                            <div class="blog-date mr-25 text-center">
                                <h2>12 <span>Feb</span></h2>
                            </div>
                            <div class="blog-list-info single-blog-info mb-25">
                                <h4><a href="blog.html">Men’s New Trend</a></h4>
                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure</p>
                            </div>
                        </div>
                        <div class="single-blog-list">
                            <div class="blog-date mr-25 text-center">
                                <h2>15 <span>Feb</span></h2>
                            </div>
                            <div class="blog-list-info single-blog-info mb-25">
                                <h4><a href="blog.html">Fashion Show</a></h4>
                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure</p>
                            </div>
                        </div>
                        <div class="single-blog-list">
                            <div class="blog-date mr-25 text-center">
                                <h2>20 <span>Feb</span></h2>
                            </div>
                            <div class="blog-list-info single-blog-info mb-25">
                                <h4><a href="blog.html">Dress for Curte Gril</a></h4>
                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure</p>
                            </div>
                        </div>
                        <div class="single-blog-list hidden-md">
                            <div class="blog-date mr-25 text-center">
                                <h2>09 <span>Feb</span></h2>
                            </div>
                            <div class="blog-list-info single-blog-info mb-25">
                                <h4><a href="blog.html">Latest Handbag Collection</a></h4>
                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tweet" role="tabpanel" class="section-tab-item">
                    <div class="col-md-4">
                        <div class="single-twitter mb-10">
                            <div class="twitter-icon">
                                <img src="{{ asset('public/frontend/img/icon/twitter.png') }}" alt="">
                            </div>
                            <div class="twitter-feed">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur maiores rem dolores. <a>-jan 18, 2016</a></p>
                            </div>
                        </div>
                        <div class="single-twitter mb-10">
                            <div class="twitter-icon">
                                <img src="{{ asset('public/frontend/img/icon/twitter.png') }}" alt="">
                            </div>
                            <div class="twitter-feed">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur maiores rem dolores. <a>-jan 18, 2016</a></p>
                            </div>
                        </div>
                        <div class="single-twitter">
                            <div class="twitter-icon">
                                <img src="{{ asset('public/frontend/img/icon/twitter.png') }}" alt="">
                            </div>
                            <div class="twitter-feed">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur maiores rem dolores. <a>-jan 18, 2016</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-twitter mb-10">
                            <div class="twitter-icon">
                                <img src="{{ asset('public/frontend/img/icon/twitter.png') }}" alt="">
                            </div>
                            <div class="twitter-feed">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur maiores rem dolores. <a>-jan 18, 2016</a></p>
                            </div>
                        </div>
                        <div class="single-twitter mb-10">
                            <div class="twitter-icon">
                                <img src="{{ asset('public/frontend/img/icon/twitter.png') }}" alt="">
                            </div>
                            <div class="twitter-feed">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur maiores rem dolores. <a>-jan 18, 2016</a></p>
                            </div>
                        </div>
                        <div class="single-twitter">
                            <div class="twitter-icon">
                                <img src="{{ asset('public/frontend/img/icon/twitter.png') }}" alt="">
                            </div>
                            <div class="twitter-feed">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur maiores rem dolores. <a>-jan 18, 2016</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-twitter mb-10">
                            <div class="twitter-icon">
                                <img src="{{ asset('public/frontend/img/icon/twitter.png') }}" alt="">
                            </div>
                            <div class="twitter-feed">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur maiores rem dolores. <a>-jan 18, 2016</a></p>
                            </div>
                        </div>
                        <div class="single-twitter mb-10">
                            <div class="twitter-icon">
                                <img src="{{ asset('public/frontend/img/icon/twitter.png') }}" alt="">
                            </div>
                            <div class="twitter-feed">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur maiores rem dolores. <a>-jan 18, 2016</a></p>
                            </div>
                        </div>
                        <div class="single-twitter">
                            <div class="twitter-icon">
                                <img src="{{ asset('public/frontend/img/icon/twitter.png') }}" alt="">
                            </div>
                            <div class="twitter-feed">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur maiores rem dolores. <a>-jan 18, 2016</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="instagram" role="tabpanel" class="section-tab-item">
                    <div class="row mb-25">
                        <div class="col-md-4">
                            <div class="single-instagram">
                                <a href="#">
                                    <img src="{{ asset('public/frontend/img/blog/1.jpg') }}" alt="blog">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-instagram">
                                <a href="#">
                                    <img src="{{ asset('public/frontend/img/blog/2.jpg') }}" alt="blog">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-instagram">
                                <a href="#">
                                    <img src="{{ asset('public/frontend/img/blog/1.jpg') }}" alt="blog">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-instagram">
                                <a href="#">
                                    <img src="{{ asset('public/frontend/img/blog/2.jpg') }}" alt="blog">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-instagram">
                                <a href="#">
                                    <img src="{{ asset('public/frontend/img/blog/1.jpg') }}" alt="blog">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-instagram">
                                <a href="#">
                                    <img src="{{ asset('public/frontend/img/blog/2.jpg') }}" alt="blog">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- blog area end -->
<!-- testimonial area start -->
<div class="testimonial-area pt-100 pb-45">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-4 col-sm-3 col-xs-12">
                <div class="testimonial-left text-right">
                    <h2>CUSTOMER REVIEWS</h2>
                    <p class="hidden-sm">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was bornad</p>
                </div>
            </div>
            <div class="col-lg-7 col-md-8 col-sm-9 col-xs-12">
                <div class="testi-owl">
                    <div class="testimonial-right">
                        <div class="testimonial-img">
                            <img src="{{ asset('public/frontend/img/testimonial/1.jpg') }}" alt="">
                        </div>
                        <div class="testimonial-info">
                            <h3>Zaculine Jenelia, <span> Head Of Business</span></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et lore magna aliqua. Ut enim ad minim veniam quis</p>
                        </div>
                    </div>
                    <div class="testimonial-right">
                        <div class="testimonial-img">
                            <img src="{{ asset('public/frontend/img/testimonial/1.jpg') }}" alt="">
                        </div>
                        <div class="testimonial-info">
                            <h3>Zaculine Jenelia, <span> Head Of Business</span></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et lore magna aliqua. Ut enim ad minim veniam quis</p>
                            <a href="#" class="section-button mt-30">view more</a>
                        </div>
                    </div>
                    <div class="testimonial-right">
                        <div class="testimonial-img">
                            <img src="{{ asset('public/frontend/img/testimonial/1.jpg') }}" alt="">
                        </div>
                        <div class="testimonial-info">
                            <h3>Zaculine Jenelia, <span> Head Of Business</span></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et lore magna aliqua. Ut enim ad minim veniam quis</p>
                            <a href="#" class="section-button mt-30">view more</a>
                        </div>
                    </div>
                    <div class="testimonial-right">
                        <div class="testimonial-img">
                            <img src="{{ asset('public/frontend/img/testimonial/1.jpg') }}" alt="">
                        </div>
                        <div class="testimonial-info">
                            <h3>Zaculine Jenelia, <span> Head Of Business</span></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et lore magna aliqua. Ut enim ad minim veniam quis</p>
                            <a href="#" class="section-button mt-30">view more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- testimonial area end -->
@endsection