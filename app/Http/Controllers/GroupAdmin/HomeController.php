<?php

namespace App\Http\Controllers\GroupAdmin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:group_admin');
    }
    
    public function index(){
        return view('group_admin.dashboard');
    }
}
