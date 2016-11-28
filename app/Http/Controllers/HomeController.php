<?php

namespace App\Http\Controllers;

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
        $data = $request->all();
        Mail::send('emails.add_organization', ['data' => $data], function ($m) use ($data) {
            $m->from('lookrestaurants@gmail.com', 'Look Restaurants Application');

            $m->to('lookrestaurants@gmail.com')->subject('Add Organization');
        });
    }
}
