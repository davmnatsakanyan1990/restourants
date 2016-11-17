<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public $place;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->place = Auth::guard('admin')->user()->place;
    }

    public function index(){

        $is_blocked = true;
        if(is_null($this->place->deleted_at)){
            $is_blocked = false;
        }
        $place = $this->place;
        
        return view('admin.dashboard', compact('is_blocked', 'place'));
    }
}
