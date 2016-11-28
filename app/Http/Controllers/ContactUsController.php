<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{

    /**
     * Send mail to the super admin - Contact Us
     * 
     * @param Request $request
     */
    public function sendMail(Request $request){
        dd($request->all());
        $data = $request->all();
        Mail::send('emails.contact_us', ['data' => $data], function ($m) use ($data) {
            $m->from('lookrestaurants@gmail.com', 'Look Restaurants Application');

            $m->to('lookrestaurants@gmail.com')->subject('Contact us');
        });
    }
}
