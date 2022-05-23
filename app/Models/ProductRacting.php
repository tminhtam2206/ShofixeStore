<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRacting extends Model
{
    use HasFactory;

    protected $table = 'product_racting';

    protected $dates = ['created_at', 'updated_at'];

    public function Product(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function User(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
