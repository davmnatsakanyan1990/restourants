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
     * Send mail to the super admin - Add Organization
     */
    public function addOrganization(Request $request){
        dd($request->all());
        $this->validate($request, [
            //TODO validation rules
        ]);
        $data = $request->all();
        Mail::send('emails.add_organization', ['data' => $data], function ($m) use ($data) {
            $m->from(env('MAIL_FROM'), 'Look Restaurants Application');

            $m->to(env('MAIL_FROM'))->subject('Add Organization');
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
