<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';

    public function Order(){
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }

    public function Product(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}
