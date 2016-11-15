<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public $admin;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->admin = Auth::guard('admin')->user();
    }

    public function show(){

    }

    public function edit(){
        $admin = Auth::guard('admin')->user()->toArray();

        return view('admin.update_account_details', compact('admin'));
    }

    public function update_pers_info(Request $request){
        Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $request->name, 'email' => $request->email]);
        
        return redirect()->back()->with('message', 'Data was successfully updated');
    }

    public function update_sec_info(Request $request){
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);
        $password = bcrypt($request->old_password);

        if($password == Auth::guard('admin')->user()->password){
           Admin::where('id', )
        }
    }
}
