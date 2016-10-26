<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct()
    {
        if(Auth::guard('user')->guest()){
            abort(503);
        }
    }
    
    public function create(Request $request){
        
    }
}
