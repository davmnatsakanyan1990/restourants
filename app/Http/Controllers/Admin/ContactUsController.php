<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show contact us form
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('admin/contact_us');
    }

    /**
     * Send message to the support
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request){
        $this->validate($request, [
            // TODO validation rules 
        ]);

        Mail::send('emails.admin_contact_us', ['request' => $request], function ($m) use ($request) {
            $m->from($request->email, 'Look Restaurants Application');

            $m->to(env('SUPPORT_MAIL'))->subject($request->subject);
        });
        
        return redirect()->back()->with('message', 'Your message was successfully sent');
    }
}
