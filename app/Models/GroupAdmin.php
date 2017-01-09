<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GroupAdmin extends Authenticatable
{
    protected $fillable = [
        'name',
        'username'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
