<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Location;
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
       $place = Place::withTrashed()->with(['highlights', 'cuisins', 'workinghour', 'categories', 'location', 'types'])
            ->find($this->place->id)->toArray();

        $cities = City::select('id', 'name')->get()->toArray();
        $locations = City::with('locations')->find($place['location']['city_id'])->locations->toArray();

        //dd($place);
        return view('admin.place_edit', compact('place', 'cities', 'locations'));
    }
    
    public function update(Request $request){
        dd($request->all());
        Place::withTrashed()->where('admin_id', $this->place->id)->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'intro' => $request->intro,
            'address' => $request->address,
            'cost' => $request->cost
        ]);


    }
}
