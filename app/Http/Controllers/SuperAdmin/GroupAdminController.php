<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\GroupAdmin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GroupAdminController extends Controller
{
    protected $super_admin;

    public function __construct(){
        $this->middleware('auth:super_admin');

        if(Auth::guard('super_admin')->check())
            $this->super_admin = Auth::guard('super_admin')->user();
    }
    
    
    public function create(){
        return view('super_admin.create_group_admin');
    }
    
    public function save(Request $request){
        GroupAdmin::create([
            'name' => $request->name, 
            'username' => $request->username, 
            'password' => bcrypt($request->password)
        ]);
        
        
        echo 'admin created';
    }
}
