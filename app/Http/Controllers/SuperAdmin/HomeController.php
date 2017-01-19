<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Admin;
use App\Models\Place;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    protected $super_admin;

    public function __construct(){
        $this->middleware('auth:super_admin');
        
        if(Auth::guard('super_admin')->check())
            $this->super_admin = Auth::guard('super_admin')->user();
    }
    
    public function index(){
        return view('super_admin/home');
    }
    
    public function update(Request $request){
        
        $this->validate($request, [
            'rest_name' => 'required',
        ]);
        
        $admin = Place::find($request->place_id)->admin;

        Admin::find($admin->id)->update(['name' => $request->admin_name, 'email' => $request->admin_email]);

        Place::where('id', $request->place_id)->update(['name' => $request->rest_name, 'mobile' => $request->rest_phone]);
        
        return response()->json(['status'=>1]);
    }
    
    
}
