<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminDetails extends Model
{
    protected $fillable = [
        'admin_id',
        'username',
        'password'
    ];
}
