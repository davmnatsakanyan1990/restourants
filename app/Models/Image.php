<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    // role=0 Default
    // role=1 Place Cover
    // role=2 Place Thumbnail
    // ...


    public function imageable(){
        return $this->morphTo();
    }
}
