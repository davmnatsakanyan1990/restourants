<?php

namespace App\Http\Controllers\SuperAdmin;

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
    
    public function index(){
        $restaurants = Place::simplePaginate(15);

        foreach($restaurants->items() as $item){
            if($item->plan_id == 1)
                $item->days_remaining = $this->getRemainingTime($item->id);
            else if($item->plan_id == 2)
                $item->days_remaining = 'purchased';
        }

        $group_admins = GroupAdmin::all()->toArray();
        
        return view('super_admin.places', compact('restaurants', 'group_admins'));
        
    }

    public function update(Request $request, $place_id){
        Place::find($place_id)->update(['group_admin_id' => $request->admin_id]);
        
        return 1;
    }

    public function getRemainingTime($place_id){
        $first_login =  Place::find($place_id)->first_login;
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
