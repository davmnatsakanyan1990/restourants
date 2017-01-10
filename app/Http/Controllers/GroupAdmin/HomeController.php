<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Models\Place;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $admin;
    public function __construct()
    {
        $this->middleware('auth:group_admin');

        if(Auth::guard('group_admin')->check())
            $this->admin = Auth::guard('group_admin')->user();
    }
    
    public function index(){
        $restaurants = Place::with(['notes' => function($notes){
                return $notes->orderBy('created_at', 'desc');
            }])
            ->where('group_admin_id', $this->admin->id)
            ->paginate(20);
        
        return view('group_admin.dashboard', compact('restaurants'));
    }
}
