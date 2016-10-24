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
        'city',
        'lat',
        'lon',
        'site',
        'price_from',
        'price_to',
        'wrk_hrs_from',
        'wrk_hrs_to',
    ];
    
    public function images(){
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function thumb_image(){
        return $this->morphMany('App\Models\Image', 'imageable')->where('role', 1);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function rates(){
        return $this->hasMany(Rate::class);
    }
    
    public function shares(){
        return $this->hasMany(Share::class);
    }
    
    public function menus(){
        return $this->hasMany(Menu::class);
    }
    
    public function highlights(){
        return $this->belongsToMany(Highlight::class, 'place_highlights');
    }
    
    public function cuisins(){
        return $this->belongsToMany(Cuisin::class);
    }

    public function workinghour(){
        return $this->hasOne(WorkingHour::class);
    }
    
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    
    public function location(){
        return $this->belongsTo(Location::class);
    }
    
    public function types(){
        return $this->belongsToMany(Type::class);
    }
}
