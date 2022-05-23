<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $dates = ['created_at', 'updated_at'];

    public function TypeProduct(){
        return $this->belongsTo('App\Models\TypeProduct', 'type_product_id', 'id');
    }

    public function Product(){
        return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }
}
