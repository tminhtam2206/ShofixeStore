<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    use HasFactory;

    protected $table = 'type_product';

    protected $dates = ['created_at', 'updated_at'];

    public function Category(){
        return $this->hasMany('App\Models\Category', 'type_product_id', 'id');
    }
}
