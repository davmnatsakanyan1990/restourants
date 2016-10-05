<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'mobile',
        'name',
        'intro',
        'address',
        'lat',
        'lon',
        'site',
        'price_from',
        'price_to',
        'wrk_hrs_from',
        'wrk_hrs_to',
        
    ];
}
