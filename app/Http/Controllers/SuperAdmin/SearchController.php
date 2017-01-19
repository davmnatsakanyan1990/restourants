<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Place;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:super_admin');
    }
    
    public function search(){
        $id = request('search');
        $place = Place::where('support_id', $id)->first();
        
        return view('super_admin/search_results', compact('place'));
    }
}
