<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Đặt hàng thành công - {{ config('app.name') }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .header-left {
            width: 30%;
            float: left;
        }

        .header-center {
            width: 40%;
            float: left;
        }

        .header-right {
            width: 30%;
            float: left;
        }

        #customers {
            font-family: DejaVu Sans, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #000;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers th {
            text-align: left;
            color: black;
        }
    </style>
</head>

<body>
    <div style="width: 50%; float: left;">
        <p style="font-size: 10px; font-weight: 10; font-family: DejaVu Sans, sans-serif;">Ngày Tạo: {{ date('d-m-Y H:m:i', strtotime($order->created_at)) }}</p>
    </div>
    <div style="width: 50%; float: left;">
        <p style="font-size: 10px; font-weight: 100; font-family: DejaVu Sans, sans-serif; text-align: right;">{{ config('app.name') }}</p>
    </div>
    <div style="clear: both;"></div>
    <hr>
    <div class="header-left"><img src="https://1.bp.blogspot.com/-4aafv9LG2nw/YG_Uk0pstZI/AAAAAAAAFIA/q3N0_a3aGvoswxcuLUpVA25_Y7m4cUaKgCLcBGAsYHQ/s16000/logo.png" alt=""></div>
    <div class="header-center">
        <h3 style="text-align: center;">HÓA ĐƠN THANH TOÁN</h3>
        <p style="text-align: center;"><i style="font-size: 10px; font-weight: 10;">(Mail xác nhận đơn hàng)</i></p>

    </div>
    <div class="header-right">
        <p style="font-size: 12px; font-weight: 50; text-align: right;">Mẫu số: PK01/001</p>
        <p style="font-size: 12px; font-weight: 50; text-align: right;">Mã đơn hàng: #{{ $order->id }}</p>
    </div>
    <br><br><br><br><br>

    <p>Xin chào: <b>{{ Auth::user()->name }}!</b></p>
    <p>Cảm ơn bạn đã đặt hàng tại {{ config('app.name') }}.</p>
    <br>
    <p style="font-weight: 700;"><b>THÔNG TIN GIAO HÀNG:</b></p>
    <div class="info">
        <p style="font-size: 11px;"><strong>Tên người nhận</strong>: <span style="font-family: DejaVu Sans, sans-serif !important; text-transform: capitalize;">{{ $order->name }}</span></p>
        <p style="font-size: 11px;"><strong>Địa chỉ</strong>: <span>{{ $order->address }}</span></p>
        <p style="font-size: 11px;"><strong>Số Điện Thoại</strong>: <span>{{ $order->phone }}</span></p>
        <p style="font-size: 11px;"><strong>Ghi chú</strong>: <span>{{ $order->note }}</span></p>
    </div>
    <p>THÔNG TIN ĐƠN HÀNG:</p>
    <table id="customers">
        <thead>
            <tr>
                <th style="text-align: center;">STT</th>
                <th style="text-align: center;">Sản Phẩm</th>
                <th style="text-align: center;">Giá Bán</th>
                <th style="text-align: center;">SL</th>
                <th style="text-align: center;">Giảm Giá</th>
                <th style="text-align: center;">Kích Thước</th>
                <th style="text-align: center;">Màu Sắc</th>
                <th style="text-align: center;">Thành Tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->OrderDetail as $value)
            <tr>
                <th>{{ $loop->index+1 }}</th>
                <td>{{ $value->Product->name }}</td>
                <td style="text-align: right;">{{ number_format($value->price) }}<sup>đ</sup></td>
                <td style="text-align: center;">{{ $value->amount }}</td>
                <td style="text-align: center;">{{ $value->discount }}%</td>
                <td style="text-align: center;">{{ $value->size }}</td>
                <td style="text-align: center;">{{ $value->color }}</td>
                <td style="text-align: right;">{{ number_format($value->price * $value->amount) }}<sup>đ</sup></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="width: 50%; float: left;"><h3>TỔNG THANH TOÁN:</h3></div>
    <div style="width: 50%; float: left; text-align: right; color: red;"><h3><span>{{ number_format($order->total) }}<sup>đ</sup></span></h3></div>

    <p style="width: 100%; text-align: center;">Trân trọng, {{ config('app.name') }}.</p>
</body>

</html>