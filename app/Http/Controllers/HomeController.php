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
        $places = Place::all();
        return $places->toArray();
    }
}
