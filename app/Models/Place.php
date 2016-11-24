<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
        'support_id'
    ];
    
    public function images(){
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function thumb_image(){
        return $this->morphMany('App\Models\Image', 'imageable')->where('role', 1);
    }

    public function comments(){
        return $this->hasMany(Comment::class)->where('parent_id', 0);
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
        return $this->belongsToMany(Cuisin::class, 'place_cuisins');
    }

    public function workinghour(){
        return $this->hasOne(WorkingHour::class);
    }
    
    public function categories(){
        return $this->belongsToMany(Category::class, 'place_categories');
    }
    
    public function location(){
        return $this->belongsTo(Location::class);
    }
    
    public function types(){
        return $this->belongsToMany(Type::class, 'place_types');
    }
    
    public function admin(){
        return $this->hasOne('App\Models\Place');
    }
    
    public function payment(){
        return $this->hasOne(Payment::class);
    }
}
