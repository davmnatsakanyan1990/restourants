<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    protected $super_admin;

    public function __construct(){
        $this->middleware('auth:super_admin');

        $this->super_admin = Auth::guard('super_admin')->user();
    }
    
    public function index(){
        dd($this->super_admin);
    }
}
