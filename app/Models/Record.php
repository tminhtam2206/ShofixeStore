<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model{
    use HasFactory;

    protected $table = 'record';

    protected $dates = ['created_at', 'updated_at'];

    public function User(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
