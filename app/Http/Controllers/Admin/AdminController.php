<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show(){

    }

    public function edit(){
        $admin = Auth::guard('admin')->user();
        dd($admin);
        return view('admin.update_account_details');
    }

    public function update(){

    }
}
