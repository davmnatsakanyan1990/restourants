<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GroupAdmin extends Authenticatable
{
    protected $fillable = [
        'name',
        'username',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function places(){
        return $this->hasMany(Place::class);
    }
}
