<?php

namespace App\Http\Controllers\Admin;

use App\Models\Place;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{

    public $place;
    public function __construct()
    {
        $this->middleware('auth:admin');

        if(Auth::guard('admin')->check())
            $this->place = Auth::guard('admin')->user()->place;
    }

    public function edit(){
       $place = Place::with(['highlights', 'cuisins', 'workinghour', 'categories', 'location', 'types'])
            ->find($this->place->id);
        dd($place->toArray());
        return view('admin.place_edit');
    }
    
    public function update(Request $request){
        Place::where('admin_id', $this->place->id)->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'intro' => $request->intro,
            'address' => $request->address,
            'cost' => $request->cost
        ]);


    }
}
