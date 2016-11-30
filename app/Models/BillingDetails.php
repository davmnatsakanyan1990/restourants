<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingDetails extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'address_1',
        'address_2',
        'city',
        'postal_code',
        'state',
        'country',
        'phone',
        'email',
        'admin_id'
    ];
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
