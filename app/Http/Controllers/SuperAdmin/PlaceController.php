<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\City;
use App\Models\GroupAdmin;
use App\Models\Place;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    protected $super_admin;

    public function __construct(){
        $this->middleware('auth:super_admin');

        if(Auth::guard('super_admin')->check())
            $this->super_admin = Auth::guard('super_admin')->user();
    }
    
    public function index(Request $request){
        $city = $request->city;
        $status = $request->status;

        $restaurants = Place::withTrashed();
        if($request->city && $request->city != 'all') {
            $restaurants = $restaurants->with(
                'location')->whereHas('location', function ($query) use ($request) {
                $query->where('city_id', $request->city);
            });
        }
        if($request->status && $request->status == 'loggedIn'){

            $restaurants = $restaurants->whereNotNull('first_login');
        }

        $restaurants = $restaurants->simplePaginate(15);

        foreach($restaurants->items() as $item){
            if($item->plan_id == 1)
                $item->days_remaining = $this->getRemainingTime($item->id);
            else if($item->plan_id == 2)
                $item->days_remaining = 'purchased';
        }

        $group_admins = GroupAdmin::all()->toArray();
        $cities = City::all()->toArray();
        
        return view('super_admin.places', compact('restaurants', 'group_admins', 'cities', 'city', 'status'));
        
    }

    public function update(Request $request, $place_id){

        if($request->admin_id != '') {
            Place::withTrashed()->where('id', $place_id)->update(['group_admin_id' => $request->admin_id]);
        }
        else{
            Place::withTrashed()->where('id', $place_id)->update(['group_admin_id' => null]);
        }
            return 1;

    }

    public function getRemainingTime($place_id){
        $first_login =  Place::withTrashed()->find($place_id)->first_login;
        if($first_login) {
            $days = ((strtotime($first_login) + 432000) - strtotime(date("Y-m-d H:i:s"))) / 86400;
            if ($days <= 0) {
                return 'expired';
            } else {
                return round($days);
            }
        }
        else{
            return 'not_logged_in';
        }

        // 1: not logged in
        // 2: expired
        // 3: purchased
        // 4: remaining days

    }
}
