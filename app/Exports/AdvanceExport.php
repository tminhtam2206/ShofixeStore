<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdvanceExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $from;
    public $to;

    public function __construct($fromm, $tooo)
    {
        $this->from = $fromm;
        $this->to = $tooo;
    }

    public function collection()
    {
        return Order::whereBetween('created_at', [$this->from, $this->to])->where('status', 'Đã nhận')->orderBy('created_at', 'desc')->get();
    }

    public function map($order): array{
        return [
            $order->id,
            $order->User->name,
            $order->name,
            $order->phone,
            $order->address,
            $order->note,
            number_format($order->total),
            $order->status,
            Carbon::parse($order->created_at)->format('d-m-Y'),
            Carbon::parse($order->updated_at)->format('d-m-Y')
        ];
    }

    public function headings(): array{
        return [
            '#',
            'Người Đặt',
            'Người Nhận',
            'SĐT',
            'Địa chỉ',
            'Ghi chú',
            'Tổng Tiền',
            'Trạng Thái',
            'Tạo lúc',
            'Cập nhật lúc',
        ];
    }
}
