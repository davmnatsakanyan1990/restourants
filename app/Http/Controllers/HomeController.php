<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Place;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function __construct(){
        
    }

    /**
     * Send mail to the super admin - Add Location
     * 
     * @param Request $request
     */
    public function addLocation(Request $request){
        
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'phoneNumber' => 'required',
            'description' => 'required',
            'website' => 'required',
            'email' => 'required'
        ]);
        
        Mail::send('emails.add_location', ['request' => $request], function ($m) use ($request) {
            $m->from($request->email, 'Look Restaurants Application');

            $m->to(env('SUPPORT_MAIL'))->subject('Add Location');
        });
    }

    /**
     * Send mail to the super admin - Add Organization
     * 
     * @param Request $request
     */
    public function registerOwner(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'sureName' => 'required',
            'gender' => 'required',
            'phoneNumber' => 'required',
            'description' => 'required',
            'website' => 'required',
            'email' => 'required'
        ]);

        Mail::send('emails.register_owner', ['request' => $request], function ($m) use ($request) {
            $m->from($request->email, 'Look Restaurants Application');

            $m->to(env('SUPPORT_MAIL'))->subject('Register Owner');
        });
    }

    /**
     * Send mail to the super admin - Noticed Mistake
     *
     * @param Request $request
     */
    
    public function noticedMistake(Request $request){
        $this->validate($request, [
            'email'=> 'required',
            'description' => 'required'
        ]);

        Mail::send('emails.noticed_mistake', ['request' => $request], function ($m) use ($request) {
            $m->from($request->email, 'Look Restaurants Application');

            $m->to(env('SUPPORT_MAIL'))->subject('Noticed Mistake');
        });
    }
    
    public function getRootData(){
        $cities = City::select(['id', 'name'])->get();
        $data['cities'] = $cities;
        $data['current_city'] = City::where('id', 1)->select(['id', 'name'])->first(); //TODO change city by location
        return $data;
    }
    
    public function detectUserCity(Request $request){
        foreach($request->addresses as $address){
            $city = City::where('name', $address['long_name'])->first();
            if($city){
                return response()->json(['city' => $city, 'status' => 1]);
            }
        }

        return response()->json(['status' => 0]);
    }
}
