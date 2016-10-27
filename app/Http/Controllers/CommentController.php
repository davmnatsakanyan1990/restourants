<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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
        if($request->user_type == 'user') {
            $author_id = Auth::guard('user')->user()->id;
            $author_type = 'App\User';
        }
        elseif($request->user_type == 'admin'){
            $author_id = Auth::guard('admin')->user()->id;
            $author_type = 'App\Models\Admin';
        }
        
        $text = $request->text;
        $place_id = $request->id;


        Comment::insert(['text' => $text, 'place_id' => $place_id, 'commentable_id' => $author_id, 'commentable_type' => $author_type]);
    }
}
