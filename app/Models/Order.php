<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => 'string',
    ];

    protected $table = 'order';

    public function User(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function OrderDetail(){
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id');
    }
}
