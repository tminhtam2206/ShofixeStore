@extends('layouts.frontend')
@section('title', 'Yêu Thích')
@section('content')
<div class="shop-area mt-90">
    <div class="container">
        <div class="row">
            <div class="shop-item-filter">
                <div class="col-lg-4 col-md-3 col-sm-5 col-xs-5">
                    <div class="shop-tab clearfix">
                        <!-- Nav tabs -->
                        <ul role="tablist">
                            <li role="presentation" class="active"><a data-toggle="tab" role="tab" aria-controls="grid" class="grid-view" href="#grid"><i class="fa fa-th"></i></a></li>
                            <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list" class="list-view" href="#list"><i class="fa fa-list"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5 hidden-sm hidden-xs"></div>
                
                <!-- <div class="col-lg-4 col-md-4 col-sm-7 col-xs-7">
                    <div class="page-menu float-right">
                        <ul>
                            <li class="li-page">page: </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li class="hidden-xs"><a href="#">3</a></li>
                            <li class="hidden-xs"><a href="#">4</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div> -->

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="tab-content mt-25">
            <div id="grid" class="tab-pane active" role="tabpanel">
                <div class="row">
                    <!-- start loop favourite -->
                    @foreach($favourite as $value)
                    <div class="col-xs-12 col-width">
                        <div class="single-product mb-30">
                            <div class="single-product-item clearfix">
                                <div class="single-product-img clearfix">
                                    <a href="#">
                                        <img class="primary-image" src="{{ firstProductImage($value->image) }}">
                                    </a>
                                    <div class="wish-icon-hover text-center clearfix">
                                        <div class="hover-text">
                                            <p>{{ $value->summary }}</p>
                                            <ul>
                                                <li><span data-toggle="Thêm vào giỏ hàng" title="Thêm vào giỏ hàng" onclick="add_to_cart('{{ $value->id }}')"><i class="fas fa-cart-plus"></i></span></li>
                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Yêu thích"><i id="favourite-{{ $value->id }}" class="btn-add-favourite fa fa-heart" data-product-id="{{ $value->id }}" data-user-id="{{ Auth::id() }}"></i></span></li>
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
                                <span class="black hidden-sm">new</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- end loop favourite -->
                </div>
            </div>


            <div id="list" class="tab-pane" role="tabpanel">
                <div class="row">
                    <div class="col-md-3">
                        <div class="shop-left-sidebar">
                            <div class="single-left-widget">
                                <div class="section-title">
                                    <h4 class="text-uppercase" style="font-family: Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,sans-serif!important; font-weight: 700;">danh mục</h4>
                                    <ul>
                                        @foreach($category as $value)
                                        <li class="active"><a href="#" style="font-family: Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,sans-serif!important;"><i class="fa fa-angle-right"></i>{{ $value->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="single-left-widget">
                                <div class="section-title">
                                    <h4 class="text-uppercase" style="font-family: Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,sans-serif!important; font-weight: 700;">thương hiệu</h4>
                                    <ul>
                                        @foreach($brand as $value)
                                        <li><a href="#" style="font-family: Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,sans-serif!important;"><i class="fa fa-angle-right"></i>{{ $value->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="row">
                            <!-- start loop list -->
                            @foreach($favourite as $value)
                            <div class="single-product shop-list mb-48">
                                <div class="single-product-item clearfix">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <div class="single-product-img clearfix">
                                                <a href="{{ route('frontend.product_detail', ['name_slug' => $value->name_slug, 'id' => $value->id]) }}">
                                                    <img class="primary-image" src="{{ firstProductImage($value->image) }}">
                                                </a>
                                            </div>
                                            <div class="new-sale list">
                                                <span class="black">new</span>
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
                                                <p style="width: 100%;">{{ $value->summary }}</p>
                                            </div>
                                            <div class="wish-icon-hover-list text-left clearfix">
                                                <ul>
                                                    <li><span data-toggle="Thêm vào giỏ hàng" title="Thêm vào giỏ hàng" style="cursor: pointer;" onclick="add_to_cart('{{ $value->id }}')"><i class="fas fa-cart-plus"></i></span></li>
                                                    <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                    <li><span data-toggle="tooltip" title="Yêu thích" style="cursor: pointer;"><i id="favourite-{{ $value->id }}" class="btn-add-favourite fa fa-heart" data-product-id="{{ $value->id }}" data-user-id="{{ Auth::id() }}"></i></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- end loop list -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection