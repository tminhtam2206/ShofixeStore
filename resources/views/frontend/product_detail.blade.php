@extends('layouts.frontend')
@section('title', 'Chi Tiết Sản Phẩm')
@section('content')
<!--Start Product Details area  -->
<div class="product-detail-area pt-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="zoomWrapper clearfix">
                    <div id="img-1" class="zoomWrapper single-zoom pull-right">
                        <span>
                            <img id="zoom1" src="{{ firstProductThum_LG($product->image) }}" data-zoom-image="{{ firstProductThum_LG($product->image) }}" alt="big-1">
                        </span>
                    </div>
                    <div class="product-thumb">
                        <ul class="p-details-slider" id="gallery_01">
                            <!-- start loop product images -->
                            @foreach(getListProductImage($product->image) as $value)
                            <li>
                                <a class="elevatezoom-gallery" href="#" data-image="{{ $value }}" data-zoom-image="{{ $value }}">
                                    <img src="{{ $value }}" alt="">
                                </a>
                            </li>
                            @endforeach
                            <!-- end loop product images -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="product-detail">
                    <div class="product-title">
                        <h2 style="font-weight: 400; font-size: 22px; font-family: Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,sans-serif!important;">{{ $product->name }}
                            <div class="pro-rating" style="margin-top: 8px;">
                                @for($i = 1; $i<= 5; $i++) @if($i <=$product->marks)
                                    <i class="fa fa-star" style="color: gold;font-size: 16px;"></i>
                                    @else
                                    <i class="far fa-star" style="color: gold;font-size: 16px;"></i>
                                    @endif
                                    @endfor
                                    <small style="margin-left: 8px; font-size: 12px;">({{ $product->marks }} / <span id="num_racting">{{ $product->num_of_review }}</span> đánh giá)</small>
                            </div>
                        </h2><br><br>
                        <h4 style="font-size: 30px; font-family: Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,sans-serif!important;">
                            {{ disCount($product->discount, $product->price) }}<sup style="text-decoration: underline; font-size: 18px;">đ</sup>
                            <del style="font-size: 18px; font-family: Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,sans-serif!important;">
                            @if($product->discount > 0) {{ number_format($product->price) }}
                            <sup style="text-decoration: underline; font-size: 12px;">đ</sup> @endif</del>
                            @if($product->discount > 0)<small style="margin-left: 8px; font-size: 14px; font-family: Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,sans-serif!important; color: black;">(-{{ $product->discount }}%)</small>@endif
                        </h4>
                    </div>
                    <h5>Trạng thái: <span> @if($product->exist > 0) Có sẵn trong kho @else Tạm hết hàng @endif</span> </h5>
                    <h5 style="margin-top: 15px;">Số lượng hiện có: <span> {{ $product->exist }}</span> </h5>
                    <h5 style="margin-top: 15px; margin-bottom: 25px;">Thương hiệu: <a href="#" style="color: #1a9cb7;">{{ $product->Brand->name }}</a></h5>

                    <b style="font-family: Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,sans-serif!important; font-weight: 500; text-transform: uppercase;">Tóm tắt sản phẩm</b>
                    <p style="font-size: 15px; margin-top: 6px;">{{ $product->summary }}</p>

                    <div class="size-quantity clearfix">
                        <div class="single-size-quantity">
                            <h4 style="font-family: Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,sans-serif!important;">Kích thước:</h4>
                            <div class="search-cat">
                                <select id="product_size" class="category-items ">
                                    @foreach($product_size as $value)
                                    <option value="{{ $value->size }}">{{ $value->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="single-size-quantity">
                            <h4 style="font-family: Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,sans-serif!important;">Màu sắc:</h4>
                            <div class="search-cat">
                                <select id="product_color" class="category-items ">
                                    @foreach($product_color as $value)
                                    <option value="{{ $value->color }}">{{ $value->color }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="single-size-quantity">
                            <h4 style="font-family: Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,sans-serif!important;">Số lượng:</h4>
                            <div class="search-cat">
                                <input type="number" id="product_qty" value="1" min="0" max="{{ $product->exist }}" class="form-control">
                            </div>
                        </div>
                        <div class="frame-cart text-center">
                            <button class="btn btn-danger btn-add-to-cart" style="height: 45px; outline: none;" data-product-id="{{ $product->id }}"><i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                    <div class="wish-icon-hover-list mt-30 mb-30 text-left">
                        <ul>
                            <li class="btn btn-lg"><i class="fas fa-cart-plus"></i></li>
                            <li class="btn btn-lg"><i id="favourite-{{ $product->id }}" class="btn-add-favourite @if($favourite > 0) fa @else far @endif fa-heart" data-product-id="{{ $product->id }}" data-user-id="{{ Auth::id() }}"></i></li>
                            <li class="btn btn-lg"><i class="fa fa-refresh"></i></li>
                        </ul>
                    </div>
                    <div class="widget-color">
                        <h4 class="follow">Chia sẻ:</h4>
                        <ul>
                            <li class="facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li class="google-plus"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            <li class="linkedin"><a href="#"><i class="fab fa-instagram-square"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="product-description-tab pt-50">
                    <div class="description-tab-menu section-tab-menu pb-30" style="width: 905px; margin: auto;">
                        <ul class="clearfix" role="tablist">
                            <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Mô Tả</a></li>
                            <li role="presentation"><a href="#specification" aria-controls="specification" role="tab" data-toggle="tab">Đánh Giá</a></li>
                            <li role="presentation"><a href="#review_db" aria-controls="review_db" role="tab" data-toggle="tab">Bình Luận</a></li>
                            <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Bình Luận FB</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="description">
                            <p style="color: #212121;">{!! $product->description !!}</p>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="specification">
                            <!-- start review -->
                            @foreach($racting as $value)
                            <div class="media" style="margin-bottom: 30px;">
                                <div class="media-left media-middle" style="width: 575px;">
                                    <a href="#">
                                        <img class="media-object" src="{{ asset('storage/app/public/avatar') }}/{{ $value->User->avatar }}" style="width: 50px; height: 50px; border: 1px solid #ddd;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading" style="font-weight: 700;">
                                        <div class="float-left" style="float: left; color: #385898;">{{ $value->User->name }}</div>
                                        <div class="pro-rating" style="color: gold; float: left; margin-left: 12px;">
                                            @for($i = 1; $i<= 5; $i++) @if($i <=$value->marks)
                                                <i class="fa fa-star"></i>
                                                @else
                                                <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="date-time" style="float: right; text-align: right; font-weight: 300; font-size: 12px;">{{ $value->created_at->diffForHumans() }}</div>
                                    </h4>
                                    <div class="cls" style="clear: both; margin-bottom: 8px;"></div>
                                    <p>{{ $value->content }}</p>
                                </div>
                            </div>
                            @endforeach
                            <!-- end review -->
                            <div id="append-racting"></div>
                            <!-- start racting -->
                            <div class="racting" style="margin-top: 32px;">
                                <h1 style="font-weight: 700;">PHẦN ĐÁNH GIÁ</h1>

                                <div class="user-name" style="float: left;">Đánh Giá: </div>
                                <div class="my-racting" style="float: left; margin-left: 12px;">
                                    <div class="pro-rating" style="color: gold; margin-left: 12px;">
                                        <i class="my-star star-1 far fa-star" style="cursor: pointer;"></i>
                                        <i class="my-star star-2 far fa-star" style="cursor: pointer;"></i>
                                        <i class="my-star star-3 far fa-star" style="cursor: pointer;"></i>
                                        <i class="my-star star-4 far fa-star" style="cursor: pointer;"></i>
                                        <i class="my-star star-5 far fa-star" style="cursor: pointer;"></i>
                                    </div>
                                </div>
                                <div class="cls" style="clear: both; margin-bottom: 12px;"></div>
                                <textarea id="my-content-racting" class="form-control" name="content" cols="30" rows="10" maxlength="255" style="border: 1px solid #8c88b9; border-radius: 4px;" placeholder="Nội dung đánh giá của bạn..."></textarea>
                                <div class="text-center" style="width: 100%; margin-top: 8px;"><button id="btn-send-racting" class="btn btn-primary" style="width: 300px; margin: auto;"><i class="fas fa-paper-plane"></i> GỬI ĐÁNH GIÁ</button></div>
                            </div>
                            <!-- end racting -->
                        </div>
                        <!-- start comment db -->
                        <div role="tabpanel" class="tab-pane" id="review_db">
                            <!-- start comment -->
                            @foreach($comment as $value)
                            <div class="media" style="margin-bottom: 30px;">
                                <div class="media-left media-middle" style="width: 575px;">
                                    <a href="#">
                                        <img class="media-object" src="{{ asset('storage/app/public/avatar') }}/{{ $value->User->avatar }}" style="width: 50px; height: 50px; border: 1px solid #ddd;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading" style="font-weight: 700;">
                                        <div class="float-left" style="float: left; color: #385898;">{{ $value->User->name }}</div>
                                        <div class="date-time" style="float: right; text-align: right; font-weight: 300; font-size: 12px;">{{ $value->created_at->diffForHumans() }}</div>
                                    </h4>
                                    <div class="cls" style="clear: both; margin-bottom: 8px;"></div>
                                    <p>{{ $value->content }}</p>
                                </div>
                            </div>
                            @endforeach
                            <!-- end comment -->
                            <div id="append-comment"></div>
                            <!-- start conent comment -->
                            <div class="product-comment" style="margin-top: 32px;">
                                <h1 style="font-weight: 700;">PHẦN BÌNH LUẬN</h1>
                                <div class="cls" style="clear: both; margin-bottom: 12px;"></div>
                                <textarea id="my-content-comment" class="form-control" name="content" cols="30" rows="10" maxlength="255" style="border: 1px solid #8c88b9; border-radius: 4px;" placeholder="Nội dung bình luận của bạn..."></textarea>
                                <div class="text-center" style="width: 100%; margin-top: 8px;"><button id="btn-send-comment" class="btn btn-primary" style="width: 300px; margin: auto;"><i class="fas fa-paper-plane"></i> GỬI BÌNH LUẬN</button></div>
                            </div>
                            <!-- end content comment -->
                        </div>
                        <!-- end comment db -->
                        <div role="tabpanel" class="tab-pane" id="review">
                            <div class="ah-pif-footer mt-1">
                                <div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5" data-order-by="reverse_time" colorscheme="light" data-colorscheme="light" data-width="100%" width="100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Product Details area  -->
<!-- arrival start-->
<div class="arrival-area related clearfix mt-70">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-tab">
                    <div class="section-tab-menu text-center mb-45">
                        <ul role="tablist">
                            <li class="text-uppercase active"><a href="#"> Tương Tự</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <div class="tab-item-slider">
                        <!-- start loop -->
                        @foreach($related as $value)
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
                                                    <li><span data-toggle="Thêm vào giỏ hàng" title="Thêm vào giỏ hàng" onclick="add_to_cart('{{ $value->id }}')"><i class="fas fa-cart-plus"></i></span></li>
                                                    <li><span class="modal-view" data-view-id="{{ $value->id }}"><i class="fa fa-eye"></i></span></li>
                                                    <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                    <li><a href="#" data-toggle="tooltip" title="Like it!"><i id="favourite-{{ $value->id }}" class="btn-add-favourite fa fa-heart" data-product-id="{{ $value->id }}" data-user-id="{{ Auth::id() }}"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-product-info clearfix">
                                        <div class="pro-rating">
                                            @for($i = 0; $i < $value->marks; $i++)
                                                <i class="fa fa-star"></i>
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
                        <!-- end loop -->
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
@endsection

@section('javascript')
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1&appId=527870361017285&autoLogAppEvents=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, "script", "facebook-jssdk"));
</script>

<script>
    var my_choose_racting = 1;
    //click
    $('.star-1').click(function() {
        $('.my-star').removeClass('fa');

        $('.star-1').removeClass('far');

        $('.star-1').addClass('fa');
        $('.star-2').addClass('far');
        $('.star-3').addClass('far');
        $('.star-4').addClass('far');
        $('.star-5').addClass('far');

        my_choose_racting = 1;
    });

    $('.star-2').click(function() {
        $('.my-star').removeClass('fa');

        $('.star-1').removeClass('far');
        $('.star-2').removeClass('far');

        $('.star-1').addClass('fa');
        $('.star-2').addClass('fa');
        $('.star-3').addClass('far');
        $('.star-4').addClass('far');
        $('.star-5').addClass('far');

        my_choose_racting = 2;
    });

    $('.star-3').click(function() {
        $('.my-star').removeClass('fa');

        $('.star-1').removeClass('far');
        $('.star-2').removeClass('far');
        $('.star-3').removeClass('far');

        $('.star-1').addClass('fa');
        $('.star-2').addClass('fa');
        $('.star-3').addClass('fa');
        $('.star-4').addClass('far');
        $('.star-5').addClass('far');

        my_choose_racting = 3;
    });

    $('.star-4').click(function() {
        $('.my-star').removeClass('fa');

        $('.star-1').removeClass('far');
        $('.star-2').removeClass('far');
        $('.star-3').removeClass('far');
        $('.star-4').removeClass('far');

        $('.star-1').addClass('fa');
        $('.star-2').addClass('fa');
        $('.star-3').addClass('fa');
        $('.star-4').addClass('fa');
        $('.star-5').addClass('far');

        my_choose_racting = 4;
    });

    $('.star-5').click(function() {
        $('.my-star').removeClass('far');
        $('.my-star').addClass('fa');

        my_choose_racting = 5;
    });

    var user_id = "{{ Auth::id() }}";

    $('#btn-send-racting').click(function() {
        let token = $('#my_token').val();
        let content_curr = $('#my-content-racting').val();
        let product_id = "{{ $product->id }}";

        if (user_id != '') {
            if (content_curr != '') {
                $.ajax({
                    url: "{{ route('frontend.racting') }}",
                    data: {
                        id: product_id,
                        marks: my_choose_racting,
                        content: content_curr,
                        _token: token
                    },
                    type: 'post',
                    success: function(data_return) {
                        $('#my-content-racting').val('');
                        $('.my-star').removeClass('fa');
                        $('.my-star').addClass('far');

                        $('#append-racting').append(data_return);
                        $('#num_racting').text(parseInt($('#num_racting').text()) + 1);
                    }
                });
            } else {
                my_custom_alert('Vui lòng nhập nội dung đánh giá!');
            }
        } else {
            my_custom_alert('Vui lòng đăng nhập!');
        }
    });

    $('#btn-send-comment').click(function() {
        let token = $('#my_token').val();
        let content_curr = $('#my-content-comment').val();
        let product_id = "{{ $product->id }}";

        if (user_id != '') {
            if (content_curr != '') {
                $.ajax({
                    url: "{{ route('frontend.comment') }}",
                    data: {
                        id: product_id,
                        content: content_curr,
                        _token: token
                    },
                    type: 'post',
                    success: function(data_return) {
                        $('#my-content-comment').val('');

                        $('#append-comment').append(data_return);
                    }
                });
            } else {
                my_custom_alert('Vui lòng nhập nội dung bình luận!');
            }
        } else {
            my_custom_alert('Vui lòng đăng nhập!');
        }
    });
</script>
@endsection