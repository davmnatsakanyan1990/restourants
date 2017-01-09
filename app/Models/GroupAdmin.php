<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupAdmin extends Model
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
