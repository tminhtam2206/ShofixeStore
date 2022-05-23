@extends('layouts.backend')
@section('title', 'Phản Hồi Về Websites')
@section('content')
<div class="page-inner">
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('backend') }}"><i class="breadcrumb-icon fas fa-home mr-2"></i>Bảng Điều Khiển</a>
                </li>
                <li class="breadcrumb-item">
                    <span></i>Phản Hồi Về Websites</span>
                </li>
            </ol>
        </nav>
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto text-uppercase">Phản Hồi Về Websites</h1>
            <div class="btn-toolbar" style="width: 50px;">
                <button id="huong-dang-su-dung" title="Hướng dẫn sử dụng về trang [phản hồi]" class="btn text-primary"><i style="font-size: 30px;" class="fas fa-info-circle"></i></button> 
            </div>
        </div>
    </header>
    <div class="page-section">
        <div class="card card-fluid">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="Order-Table" class="table table-success table-striped">
                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width:25px">#</th>
                                <th>HỌ VÀ TÊN</th>
                                <th>EMAIL</th>
                                <th>NỘI DUNG</th>
                                <th style="width: 10px;">XEM</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fellback as $value)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td><input class="order-address-temp form-control" type="text" value="{{ $value->content }}" readonly></td>
                                <td class="text-center">
                                    <button data-id="{{ $value->id }}" class="btn btnview"><i id="icon-{{ $value->id }}" class="fas @if($value->approval == 'YES') fa-eye @else fa-eye-slash @endif"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Content -->
<div class="modal fade" id="OrderAddress" tabindex="-1" aria-labelledby="LableOrderAddress" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="width: 100%; border-bottom: 1px solid;">
                <h5 style="width: 100%;" class="modal-title text-center" id="LableOrderAddress">NỘI DUNG PHẢN HỒI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="Order-Detail-Address-Content">
                    This is content...
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hướng dẫn sử dụng -->
<div class="modal fade" id="model-huongdansudung" tabindex="-1" aria-labelledby="Lablehuongdansudung" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="width: 100%; border-bottom: 1px solid;">
                <h5 style="width: 100%;" class="modal-title text-center text-uppercase" id="Lablehuongdansudung">hướng dẫn sử dụng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="Order-Detail-Address-Content">
                    <b>1)</b> Để xem nội dung phản hồi, bạn chỉ cần nhấn [<b>đúp chuột trái</b>] vào ô chứa nội dung là có thể xem hết chi tiết của nó.
                    <br>
                    <br>
                    <b>2)</b> Để thay đổi trạng thái của phản hồi, bạn chỉ cần nhấn [<b>đúp chuột trái</b>] vào biểu cảm là có thể thay đổi trạng thái của nó.
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script>
    $('.btnview').dblclick(function() {
        var fellback_id = $(this).attr("data-id");
        var classname = $('#icon-'+fellback_id).attr("class");

        $.ajax({
            url: "{{ route('backend.fellback.approval') }}",
            data:{id: fellback_id},
            type: 'get',
            success:function(){

            }
        });

        if(classname == 'fas  fa-eye-slash ' || classname == 'fas  fa-eye-slash' || classname == 'fas fa-eye-slash'){
            $('#icon-'+fellback_id).removeClass('fa-eye-slash');
            $('#icon-'+fellback_id).addClass('fa-eye');
        }
        else{
            $('#icon-'+fellback_id).removeClass('fa-eye');
            $('#icon-'+fellback_id).addClass('fa-eye-slash');
        }  
    });

    $('.order-address-temp').dblclick(function() {
        let content = $(this).val();
        $('#Order-Detail-Address-Content').text(content);
        $('#OrderAddress').modal('show');
    });

    $('#huong-dang-su-dung').click(function(){
        $('#model-huongdansudung').modal('show');
    });

    $(document).ready(function() {
        $('#Order-Table').DataTable({
            language: {
                url: "{{ asset('public/backend/js/vi.json') }}"
            },
            "bSort": false
        });
    });
</script>
@endsection