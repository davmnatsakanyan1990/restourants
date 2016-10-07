<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    public function image(){
        return $this->morphTo('App\Models\Image', 'imageable');
    }
}
