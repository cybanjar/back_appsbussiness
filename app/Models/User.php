<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{   
    use Authenticatable, Authorizable;

    protected $fillable = [
        'email', 
        'password',
        'token',
        'phone',
        'pin',
        // 'username',        
        // 'photo'
    ];
    
    // protected $casts = [
    //     'phone_verified_at' => 'datetime',
    // ];

    protected $hidden = [
        'password',
    ];
}