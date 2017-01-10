<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Place;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    protected $super_admin;

    public function __construct(){
        $this->middleware('auth:super_admin');

        if(Auth::guard('super_admin')->check())
            $this->super_admin = Auth::guard('super_admin')->user();
    }
    
    public function index(){
        $restaurants = Place::simplePaginate(15);
        
        return view('super_admin.places', compact('restaurants'));
        
    }
}