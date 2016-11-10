<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{

    public $place;
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->place = Auth::guard('admin')->user()->place;
    }

    public function edit(){
        return view('admin.place_edit');
    }
}
