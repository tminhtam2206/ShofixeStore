@extends('layouts.backend')
@section('title', 'Sửa Sản Phẩm')
@section('content')
<div class="page-inner">
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('backend') }}"><i class="breadcrumb-icon fas fa-home mr-2"></i>Bảng Điều Khiển</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('backend.product') }}">Sản Phẩm</a>
                </li>
                <li class="breadcrumb-item">
                    <span></i>Chỉnh Sửa</span>
                </li>
            </ol>
        </nav>
    </header>
    <div class="page-section">
        <form id="form_edit_product" action="{{ route('backend.product.post_edit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="id" value="{{ $product->id }}" hidden>
            <div class="card card-fluid">
                <div class="card-header bg-warning text-light py-2">
                    <div class="text-center">CHI TIẾT VỀ SẢN PHẨM</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="type_product">
                            <i class="fas fa-project-diagram"></i>
                            <b>Loại Sản Phẩm </b>
                            <abbr title="Bắt buộc chọn">(*)</abbr>
                        </label>
                        <select class="custom-select" id="type_product" required>
                            <option value="">-- Chọn --</option>
                            @foreach($type_product as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_id">
                            <i class="fas fa-list-ul"></i>
                            <b>Danh Mục Sản Phẩm </b>
                            <abbr title="Bắt buộc chọn">(*)</abbr>
                        </label>
                        <select class="custom-select" id="category_id" name="category_id" required>
                            <option value="">-- Chọn --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand_id">
                            <i class="fas fa-compass"></i>
                            <b>Thương Hiệu </b>
                            <abbr title="Bắt buộc chọn">(*)</abbr>
                        </label>
                        <select class="custom-select" id="brand_id" name="brand_id" required>
                            <option value="">-- Chọn --</option>
                            @foreach($brand as $brand_value)
                            <option value="{{ $brand_value->id }}" @if($brand_value->id == $product->brand_id) selected @endif>{{ $brand_value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name" style="width: 100%;">
                            <i class="fab fa-product-hunt"></i>
                            <b>Tên Sản Phẩm </b>
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                            <span id="max-length-ten-san-pham" class="text-danger float-right"></span>
                        </label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" maxlength="25" placeholder="Tên sản phẩm của bạn là?" autocomplete="off" required />
                    </div>
                    <div class="form-group">
                        <label style="width: 100%;">
                            <i class="fas fa-images"></i>
                            <b>Hình Sản Phẩm </b>
                            <abbr title="Bắt buộc chọn">(*)</abbr>
                            <span class="float-right">
                                <label for="myinput" class="btn btn-success">
                                    <i class="fas fa-file-image"></i> Chọn Ảnh
                                    <input id="myinput" type="file" onchange="myfun()" name="image[]" accept=".jpg, .png, .webp" multiple>
                                </label>
                            </span>
                        </label>
                        <div id="showImg" class="row">
                            <div class="row">
                                @foreach(getListProductImage($product->image) as $value)
                                <div class="col-md-3"><img src="{{ $value }}" style="width:100%;height:245px;border:1px solid #dccccc;"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="banner">
                        <i class="fas fa-image"></i>
                        <b>Ảnh Bìa Sản Phẩm </b>
                        <abbr title="Bắt buộc chọn">(*)</abbr>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input id="logo" class="custom-file-input" type="file" accept=".png, .jpg, .webp" name="thumb">
                                <label class="custom-file-label" for="logo">Chọn ảnh bìa</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-code" style="width: 100%;">
                            <i class="fas fa-qrcode"></i>
                            <b>Code Sản Phẩm </b>
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                            <span id="max-length-code" class="text-danger float-right"></span>
                        </label>
                        <input type="text" class="form-control" id="edit-code" name="code" value="{{ $product->code }}" maxlength="150" placeholder="Code sản phẩm của bạn là?" autocomplete="off" style="text-transform: uppercase;" required />
                    </div>
                    <div class="form-group">
                        <label for="import">
                            <i class="fas fa-sort-numeric-up-alt"></i>
                            <b>Số Lượng Nhập </b>
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                        </label>
                        <input type="number" class="form-control weui_input weui-input" id="import" name="import" value="{{ $product->import }}" min="1" max="10000" placeholder="Số lượng nhập sản phẩm này về?" required />
                    </div>
                    <div class="form-group">
                        <label for="unit_price">
                            <i class="fas fa-money-bill-wave"></i>
                            <b>Đơn Giá </b>
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                        </label>
                        <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ number_format($product->unit_price) }}" data-type="currency" autocomplete="off" placeholder="Giá gốc của sản phẩm này là?" maxlength="13" required />
                    </div>
                    <div class="form-group">
                        <label for="price">
                            <i class="fas fa-dollar-sign"></i>
                            <b>Giá Bán </b>
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                        </label>
                        <input type="text" class="form-control" id="price" name="price" value="{{ number_format($product->price) }}" data-type="currency" autocomplete="off" placeholder="Giá bán của sản phẩm này là?" maxlength="13" required />
                    </div>
                    <div class="form-group">
                        <label for="discount">
                            <i class="fas fa-percent"></i>
                            <b>Giảm Giá </b>
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                        </label>
                        <input type="number" class="form-control weui_input weui-input" id="discount" name="discount" value="{{ $product->discount }}" placeholder="Sản phẩm này giảm giá bao nhiêu phần trăm?" min="0" max="100" required />
                    </div>
                    <div class="form-group">
                        <label>
                            <i class="fas fa-palette"></i>
                            <b>Màu Sắc </b>
                            <abbr title="Bắt buộc chọn">(*)</abbr>
                        </label> <br>
                        <div class="form-group">
                            <select id="mul-select-color" name="product_color[]" multiple="true">
                                @foreach($color as $value)
                                <option value="{{ $value->color }}" @foreach($product_color as $value_color) @if($value_color->color == $value->color) selected @endif @endforeach>{{ $value->color }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            <i class="fas fa-ruler"></i>
                            <b>Kích Thước </b>
                            <abbr title="Bắt buộc chọn">(*)</abbr>
                        </label> <br>
                        <div class="form-group">
                            <select id="mul-select-size" name="product_size[]" multiple="true">
                                @foreach($size as $value)
                                <option value="{{ $value->size }}" @foreach($product_size as $value_size) @if($value_size->size == $value->size) selected @endif @endforeach>{{ $value->size }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="video" style="width: 100%;">
                            <i class="fab fa-product-hunt"></i>
                            <b>Video Mô Tả Sản Phẩm </b>
                        </label>
                        <input type="text" class="form-control" id="video" name="video" value="{{ $product->video }}" maxlength="255" placeholder="Video mô tả sản phẩm" />
                    </div>
                    <div class="form-group">
                        <label for="summary" style="width: 100%;">
                            <i class="fas fa-file-medical-alt"></i>
                            <b>Tóm Tắt </b>
                            <abbr title="Bắt buộc nhập">(*)</abbr>
                            <span id="max-length-summary" class="text-danger float-right"></span>
                        </label>
                        <textarea class="form-control" id="summary" name="summary" rows="8" maxlength="255" required>{{ $product->summary }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">
                            <i class="fas fa-file-medical-alt"></i>
                            <b>Mô Tả </b>
                        </label>
                        <textarea class="form-control ckeditor" id="description" name="description">{{ $product->description }}</textarea>
                    </div>
                    <div class="text-center pb-3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Cập Nhật Sản Phẩm</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
<input type="text" id="token" value="{{ csrf_token() }}" hidden>
@endsection