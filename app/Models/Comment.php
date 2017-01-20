<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    protected $fillable = [
        'text',
        'place_id',
        'parent_id',
        'user_id',
        'created_at'
    ];
    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
