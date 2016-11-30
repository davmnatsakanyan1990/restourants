<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Models\Place;
use App\Models\Plan;
use CountryState;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Lib\Twocheckout\TwocheckoutCharge;
use App\Http\Controllers\Admin\Lib\Twocheckout;
use App\Http\Controllers\Admin\Lib\Twocheckout\Api\TwocheckoutError;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public $place;
    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->place = Auth::guard('admin')->user()->place;
    }

    public function show(){

    }

    public function subscribe(){
        $plans = Plan::all()->toArray();

        return view('admin.subscribe', compact('is_subscribed', 'plans'));
    }

    public function pay(Request $request)
    {
        $plan = Plan::find($request->plan);
        Twocheckout::privateKey('0ED56256-9BBD-4363-B476-F51BC23ED009');
        Twocheckout::sellerId(env('2CHECKOUT_SELLER_ID'));

        $token = $request->token;
        
        Twocheckout::verifySSL(false);  // this is set to true by default
        Twocheckout::sandbox(true);

        try {
            $charge = TwocheckoutCharge::auth(array(
                "sellerId" => env('2CHECKOUT_SELLER_ID'),
                "merchantOrderId" => request('plan'),
                "token" => $token,
                "currency" => 'USD',
                "total" => $plan->price,
                "billingAddr" => array(
                    "name" => $request->first_name.' '.$request->last_name,
                    "addrLine1" => '123 Main Street',
                    "city" => 'Townsville',
                    "state" => 'Ohio',
                    "zipCode" => '43206',
                    "country" => 'USA',
                    "email" => 'testingtester@2co.com',
                    "phoneNumber" => '555-555-5555'
                ),
                "shippingAddr" => array(
                    "name" => 'Joe Flagster',
                    "addrLine1" => '123 Main Street ',
                    "city" => 'Townsville',
                    "state" => 'Ohio',
                    "zipCode" => '43206',
                    "country" => 'USA',
                    "email" => 'testingtester@2co.com',
                    "phoneNumber" => '555-555-5555'
                )
            ));
            if ($charge['response']['responseCode'] == 'APPROVED') {
                Payment::create(['place_id' => $this->place->id, 'amount' => 10]);

                if($this->place->trashed()){
                    $this->place->restore();
                }
                return response()->json(['success' => 1,'message' => 'Thanks for Subscribing!']);
            }
        } catch (TwocheckoutError $e) {
            return response()->json(['success' => 0,'message' => $e->getMessage()]);
        }
    }
    
    public function checkout(){
        $plan_id = request('plan');
        $plan = Plan::find($plan_id);

        $billing_details = Auth::guard('admin')->user()->billing_details;

        $countries = CountryState::getCountries();
        if($billing_details->country)
            $states = CountryState::getStates($billing_details->country);
        else
            $states = [];


        return view('admin/checkout', compact('plan', 'billing_details', 'countries', 'states'));
    }
    
    public function sendMail(Request $request){
        $data = $request->all();
        Mail::send('emails.enterprise', ['data' => $data], function ($m) use ($data) {
            $m->from('lookrestaurants@gmail.com', 'Look Restaurants Application');

            $m->to('lookrestaurants@gmail.com')->subject('Enterprise');
        });
        
        return redirect()->back()->with('message', 'Your message was successfully sent');
    }
}
