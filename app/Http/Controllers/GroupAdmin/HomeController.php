<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Models\Place;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $admin;
    public function __construct()
    {
        $this->middleware('auth:group_admin');

        if(Auth::guard('group_admin')->check())
            $this->admin = Auth::guard('group_admin')->user();
    }
    
    public function index(){
        $restaurants = Place::withTrashed()->with(['notes' => function($notes){
                return $notes->orderBy('created_at', 'desc');
            }])
            ->where('group_admin_id', $this->admin->id)
            ->paginate(20);

        foreach($restaurants->items() as $item){
            if($item->plan_id == 1)
                $item->days_remaining = $this->getRemainingTime($item->id);
            else if($item->plan_id == 2)
                $item->days_remaining = 'purchased';
        }

        return view('group_admin.dashboard', compact('restaurants'));
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
    
    public function addEmail(Request $request){
        $place_id = $request->place_id;
        $email = $request->email;
        Place::where('id', $place_id)->update(['email' => $email]);
        
        return 1;
    }
}
