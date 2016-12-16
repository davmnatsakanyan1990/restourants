<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public $admin;

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->admin = Auth::guard('admin')->user();
    }

    /**
     * Show Admin-profile edit form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(){
        $admin = $this->admin->toArray();

        return view('admin.update_account_details', compact('admin'));
    }

    /**
     * Update Admin personal info
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_pers_info(Request $request){

        $this->validate($request, [
           'username' => 'required|unique:admins,username,'.$this->admin->id.',id'
        ]);
        
        Admin::where('id', $this->admin->id)->update(['name' => $request->name, 'username' => $request->username]);
        
        return redirect()->back()->with('message', 'Data was successfully updated');
    }

    /**
     * Update Admin password
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_sec_info(Request $request){
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);

        if (Hash::check($request->old_password, $this->admin->password)) {
            Admin::where('id', $this->admin->id)->update(['password' => bcrypt($request->password)]);
            return redirect()->back()->with('message', 'Your password was successfully updated');
        }
    }
}
