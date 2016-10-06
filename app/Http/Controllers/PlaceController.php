<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

use App\Http\Requests;

class PlaceController extends Controller
{
    public function test(){
        $place = Place::with([
            'services',
            'images',
            'rates' => function($rate){
                return $rate;
            },
            'comments' => function($comment){
                return $comment->with('user');
            }
            ])->findOrFail(1);
        dd($place->toArray());
    }
}
