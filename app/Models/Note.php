<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Note extends Model
{
    protected $fillable = [
        'text',
        'place_id'
    ];
}
