<?php

namespace App\Models;


use App\Cuisin;
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
    
    public function services(){
        return $this->belongsToMany(Service::class, 'place_services');
    }

    public function images(){
        return $this->morphMany('App\Models\Image', 'imageable');
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
        return $this->belongsToMany(Highlight::class);
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
}
