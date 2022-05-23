@extends('layouts.backend')
@section('title', 'Quản Lý Chính Sách')
@section('content')
<div class="page-inner">
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('backend') }}"><i class="breadcrumb-icon fas fa-home mr-2"></i>Bảng Điều Khiển</a>
                </li>
                <li class="breadcrumb-item">
                    <span></i>Quản Lý Chính Sách</span>
                </li>
            </ol>
        </nav>

        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto">QUẢN LÝ CHÍNH SÁCH</h1>
            <div class="btn-toolbar">
                <button class="btn btn-warning" onclick="CreatePolicy()" @if($policy != null) disabled @endif><i class="fas fa-file-plus"></i><span class="ml-1">Tạo Mới</span></button>
            </div>
        </div>
    </header>
    @if($policy != null)
    <div class="page-section">
        <div class="card card-fluid">
            <form action="{{ route('backend.policy.update') }}" method="post">
                @csrf
                <input type="text" value="{{ $policy->id }}" name="id" hidden>
                <div class="card-body pb-0 mb-0">
                    <div class="form-group">
                        <label for="mota">
                            <i class="fas fa-handshake"></i>
                            <b>Nội Dung Chính Sách</b>
                        </label>
                        <textarea class="form-control ckeditor" name="content">{{ $policy->content }}</textarea>
                    </div>
                </div>
                <div class="card-footer py-2">
                    <button type="submit" class="btn btn-primary" style="width: 190px; margin:auto;"><i class="fas fa-sync-alt"></i> Cập Nhật Chính Sách</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection

@section('javascript')
<script>
    function CreatePolicy() {
        $.confirm({
            title: '<i class="fas fa-bell"></i> Thông Báo',
            content: 'Bạn có muốn <b>tạo</b> chính sách mới không?',
            type: 'purple',
            buttons: {
                deleteUser: {
                    text: '<i class="fas fa-file-plus"></i> Tạo Mới',
                    btnClass: 'btn-red',
                    action: function() {
                        $(location).attr('href', "{{ route('backend.policy.create') }}");
                    }
                },
                cancelAction: {
                    text: 'Đóng',
                    btnClass: 'btn-blue'
                }
            }
        });
    }
</script>
@endsection