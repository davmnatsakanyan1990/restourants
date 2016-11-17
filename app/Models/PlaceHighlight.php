<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceHighlight extends Model
{
    protected $fillable = [
        'place_id',
        'highlight_id'
    ];
}
