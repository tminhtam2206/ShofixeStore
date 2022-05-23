<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    public function Brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }

    public function Category(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function ProductColor(){
        return $this->hasMany('App\Models\ProductColor', 'product_id', 'id');
    }

    public function ProductSize(){
        return $this->hasMany('App\Models\ProductSize', 'product_id', 'id');
    }

    public function OrderDetail(){
        return $this->hasMany('App\Models\OrderDetail', 'product_id', 'id');
    }

    public function ProductRacting(){
        return $this->hasMany('App\Models\ProductRacting', 'product_id', 'id');
    }
}
