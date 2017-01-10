<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Models\Note;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    protected $admin;
    public function __construct()
    {
        $this->middleware('auth:group_admin');

        if(Auth::guard('group_admin')->check())
            $this->admin = Auth::guard('group_admin')->user();
    }
    
    public function create(Request $request){
        Note::create(['text' => $request->text, 'place_id' => $request->place_id]);
        
        return response()->json(['success' => 1]);
    }
    
    public function getAll($place_id){
        $notes = Note::where('place_id', $place_id)->get();
        
        return $notes->toArray();
    }
}
