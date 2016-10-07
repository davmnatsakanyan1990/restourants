<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function __construct(){
        
    }
    
    public function index(){

//        format intro, create explane and add to array
//        $explane = implode(' ', array_slice(explode(' ', $place->intro), 0, 10));
//        $collection->prepend($explane, 'explane');
        
        dd('dd');
        $places = Place::all();
        return $places->toArray();
    }

}
