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

        $this->validate($request, [
           // TODO validation rules 
        ]);

        Mail::send('emails.contact_us', ['request' => $request], function ($m) use ($request) {
            $m->from($request->email, 'Look Restaurants Application');

            $m->to(env('SUPPORT_MAIL'))->subject($request->subject);
        });
    }
}
