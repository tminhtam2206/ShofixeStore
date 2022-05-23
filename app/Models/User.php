<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
        'status',
        'introduce',
        'coin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Order(){
        return $this->hasMany('App\Models\Order', 'user_id', 'id');
    }

    public function Record(){
        return $this->hasMany('App\Models\Record', 'user_id', 'id');
    }

    public function ProductRacting(){
        return $this->hasMany('App\Models\ProductRacting', 'user_id', 'id');
    }

    public function ProductComment(){
        return $this->hasMany('App\Models\ProductComment', 'user_id', 'id');
    }

    public function Favourite(){
        return $this->hasMany('App\Models\Favourite', 'user_id', 'id');
    }

    public function UserDetail(){
        return $this->hasMany('App\Models\UserDetail', 'user_id', 'id');
    }
}