<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $table = 'favourite';

    public function Product(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function User(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
