@extends('layouts.frontend')
@section('title', 'Loại & Danh Mục Sản Phẩm')
@section('content')
<style>
    .new-font{
        font-family: Arial, Helvetica, sans-serif !important; 
        font-weight: 700 !important;
    }
</style>
<div class="shop-area-start leftsidebar mt-90">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="shop-left-sidebar">
                    <div class="single-left-widget">
                        <div class="section-title">
                            <h4 class="text-uppercase new-font">DANH MỤC SẢN PHẨM</h4>
                            <ul>
                                @foreach($category as $value)
                                <li class="active">
                                    <a href="{{ route('frontend.category', ['name_slug' => $value->name_slug]) }}">
                                        <i class="fa fa-angle-right"></i>{{ $value->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="single-left-widget">
                        <div class="section-title">
                            <h4 class="text-uppercase new-font">Thương Hiệu</h4>
                            <ul>
                                @foreach($brand as $value)
                                <li>
                                    <a href="{{ route('frontend.brand', ['name_slug' => $value->name_slug]) }}">
                                        <i class="fa fa-angle-right"></i>{{ $value->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="single-left-widget">
                        <div class="section-title">
                            <h4 class="text-uppercase new-font">lọc theo giá bán</h4>
                            <div class="price-filter">
                                <div id="slider-range"></div>
                                <div class="price-slider-amount">
                                    <div class="slider-values">
                                        <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-left-widget">
                        <div class="section-title">
                            <h4 class="text-uppercase new-font">LỌC THEO KÍCH Thước</h4>
                            <ul class="size-widget">
                                <li class="active"><a href="#">XS</a></li>
                                <li><a href="#">S</a></li>
                                <li><a href="#">M</a></li>
                                <li><a href="#">L</a></li>
                                <li><a href="#">XL</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-left-widget">
                        <div class="section-title">
                            <h4 class="text-uppercase">lọc theo màu sắc</h4>
                            <ul class="color-widget">
                                <li class="active white"><a href="#"></a></li>
                                <li class="red"><a href="#"></a></li>
                                <li class="merun"><a href="#"></a></li>
                                <li class="megenta"><a href="#"></a></li>
                                <li class="blue"><a href="#"></a></li>
                                <li class="neviblue"><a href="#"></a></li>
                                <li class="green"><a href="#"></a></li>
                                <li class="yellow"><a href="#"></a></li>
                                <li class="purple"><a href="#"></a></li>
                                <li class="black"><a href="#"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="shop-item-filter">
                        <div class="col-lg-3 col-md-2 col-sm-5 col-xs-5">
                            <div class="shop-tab clearfix">
                                <!-- Nav tabs -->
                                <ul role="tablist">
                                    <li role="presentation" class="active"><a data-toggle="tab" role="tab" aria-controls="grid" class="grid-view" href="#grid"><i class="fa fa-th"></i></a></li>
                                    <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list" class="list-view" href="#list"><i class="fa fa-th-list"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 hidden-sm hidden-xs">
                            <div class="filter-by">
                                <h4>SX: </h4>
                                <form action="#">
                                    <div class="select-filter">
                                        <select>
                                            <option value="default">Mạc định</option>
                                            <option value="price">Giá bán</option>
                                            <option value="name">Tên</option>
                                            <option value="brand">Thương hiệu</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="filter-by">
                                <h4>Mức: </h4>
                                <form action="#">
                                    <div class="select-filter">
                                        <select>
                                            <option value="10">12</option>
                                            <option value="20">16</option>
                                            <option value="30">20</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-7 col-xs-7">
                            <div class="page-menu float-right">
                                <ul>
                                    <li class="li-page">Trang: </li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li class="hidden-xs"><a href="#">3</a></li>
                                    <li class="hidden-md hidden-xs"><a href="#">4</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="tab-content mt-25">
                    <div id="grid" class="tab-pane active" role="tabpanel">
                        <div class="row">
                            <!-- start loop list -->
                            @foreach($product as $value)
                            <div class="col-xs-12 col-width">
                                <div class="single-product mb-30">
                                    <div class="single-product-item clearfix">
                                        <div class="single-product-img clearfix">
                                            <a href="#">
                                                <img class="primary-image" src="{{ firstProductImage($value->image) }}" alt="">
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
                                                        <li><span class="modal-view" data-view-id="{{ $value->id }}"><i class="fa fa-eye"></i></span></li>
                                                        <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                        <li>
                                                            <span data-toggle="tooltip" title="Yêu thích">
                                                                <i id="favourite-{{ $value->id }}" class="btn-add-favourite fa fa-heart" data-product-id="{{ $value->id }}" data-user-id="{{ Auth::id() }}"></i>
                                                            </span>
                                                        </li>
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
                                    <div class="new-sale">
                                        <span class="black hidden-sm">mới</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- end loop list -->
                        </div>
                    </div>
                    <div id="list" class="tab-pane" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <!-- start loop -->
                                    @foreach($product as $value)
                                    <div class="single-product shop-list mb-48">
                                        <div class="single-product-item clearfix">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 col-sm-4">
                                                    <div class="single-product-img clearfix">
                                                        <a href="{{ route('frontend.product_detail', ['name_slug' => $value->name_slug, 'id' => $value->id]) }}">
                                                            <img class="primary-image" src="{{ firstProductImage($value->image) }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="new-sale list">
                                                        <span class="black">mới</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-8">
                                                    <div class="single-product-info mt-30 clearfix">
                                                        <h3><a href="{{ route('frontend.product_detail', ['name_slug' => $value->name_slug, 'id' => $value->id]) }}">{{ $value->name }}</a></h3>
                                                        <div class="pro-rating">
                                                            @for($i = 1; $i<= 5; $i++)
                                                            @if($i <= $value->marks)
                                                            <i class="fa fa-star" style="color: gold;"></i>
                                                            @else
                                                            <i class="far fa-star" style="color: gold;"></i>
                                                            @endif
                                                            @endfor
                                                            <span>{{ $value->num_of_review }} đánh giá</span>
                                                        </div>
                                                        <div class="pro-price">
                                                            @if($value->discount > 0)
                                                            <span class="new-price">{{ disCount($value->discount, $value->price) }}</span>
                                                            <span class="old-price">{{ number_format($value->price) }}</span>
                                                            @else
                                                            <span class="new-price">{{ disCount($value->discount, $value->price) }}</span>
                                                            @endif
                                                        </div>
                                                        <div style="clear: both;"></div>
                                                        <p>{{ $value->summary }}</p>
                                                    </div>
                                                    <div class="wish-icon-hover-list text-left clearfix">
                                                        <ul>
                                                            <li>
                                                                <span data-toggle="Thêm vào giỏ hàng" title="Thêm vào giỏ hàng" style="cursor: pointer;" onclick="add_to_cart('{{ $value->id }}')">
                                                                    <i class="fas fa-cart-plus"></i>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="modal-view" data-view-id="{{ $value->id }}" style="cursor: pointer;">
                                                                    <i class="fa fa-eye"></i>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <a href="#" data-toggle="tooltip" title="Compage">
                                                                    <i class="fa fa-refresh"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <span data-toggle="tooltip" title="Yêu thích" style="cursor: pointer;">
                                                                    <i id="favourite-{{ $value->id }}" class="btn-add-favourite fa fa-heart" data-product-id="{{ $value->id }}" data-user-id="{{ Auth::id() }}"></i>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- end loop -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection