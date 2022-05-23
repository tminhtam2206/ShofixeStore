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
                    <span></i>Quản Lý Điều Khoản</span>
                </li>
            </ol>
        </nav>

        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto">QUẢN LÝ ĐIỀU KHOẢN</h1>
            <div class="btn-toolbar">
                <button class="btn btn-warning" onclick="CreateTerm()" @if($term != null) disabled @endif><i class="fas fa-file-plus"></i><span class="ml-1">Tạo Mới</span></button>
            </div>
        </div>
    </header>
    @if($term != null)
    <div class="page-section">
        <div class="card card-fluid">
            <form action="{{ route('backend.term.update') }}" method="post">
                @csrf
                <input type="text" value="{{ $term->id }}" name="id" hidden>
                <div class="card-body pb-0 mb-0">
                    <div class="form-group">
                        <label for="mota">
                            <i class="fas fa-gavel"></i>
                            <b>Nội Dung Điều Khoản</b>
                        </label>
                        <textarea class="form-control ckeditor" name="content">{{ $term->content }}</textarea>
                    </div>
                </div>
                <div class="card-footer py-2">
                    <button type="submit" class="btn btn-primary" style="width: 190px; margin:auto;"><i class="fas fa-sync-alt"></i> Cập Nhật Điều Khoản</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection

@section('javascript')
<script>
    function CreateTerm() {
        $.confirm({
            title: '<i class="fas fa-bell"></i> Thông Báo',
            content: 'Bạn có muốn <b>tạo</b> điều khoản mới không?',
            type: 'purple',
            buttons: {
                deleteUser: {
                    text: '<i class="fas fa-file-plus"></i> Tạo Mới',
                    btnClass: 'btn-red',
                    action: function() {
                        $(location).attr('href', "{{ route('backend.term.create') }}");
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