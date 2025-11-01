<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens,Notifiable;
    use HasFactory;
    protected $table = 'users';
    
    protected $fillable = [
        'username', 'email', 'password', 'role', 'status','gender', 'name', 'dob', 'phone', 'avatar', 'address', 'provider','provider_id'
    ];

    protected $hidden =[ 
        'password', 'remember_token'
    ];

    public function address(){
        return $this->hasMany('App\Models\Address','user_id','id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
