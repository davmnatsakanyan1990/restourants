<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password', 'remember_token'
    ];

    protected $table = 'admins';

    public function comments(){
        $this->morphMany('App\Models\Comment', 'commentable');
    }
    
    public function place(){
       return $this->hasOne('App\Models\Place')->withTrashed();
    }

    public function billing_details(){
        return $this->hasOne(BillingDetails::class, 'admin_id');
    }
}
