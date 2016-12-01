<?php

namespace App\Http\Controllers\Admin;

use App\Models\BillingDetails;
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

    public function placeOrder(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'state' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'terms' => 'required',
        ]);

        if($request->payment_method == 'credit_card'){
            $this->validate($request, [
                'card_number' => 'required',
                'expires' => 'required',
                'name_on_card' => 'required',
                'CVV' => 'required'
            ]);
        }

        // Update billing details
        $details = BillingDetails::where('admin_id', $this->place->admin->id)->get()->toArray();
        if(count($details) > 0) {
            BillingDetails::where('admin_id', $this->place->admin->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'state' => $request->state,
                'country' => $request->country,
                'phone' => $request->phone,
                'email' => $request->email
            ]);
        }
        else{
            BillingDetails::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'state' => $request->state,
                'country' => $request->country,
                'phone' => $request->phone,
                'email' => $request->email,
                'admin_id' => $this->place->admin->id
            ]);
        }


        $plan = Plan::find($request->plan_id);
        Twocheckout::privateKey('0ED56256-9BBD-4363-B476-F51BC23ED009');
        Twocheckout::sellerId(env('2CHECKOUT_SELLER_ID'));

        $token = $request->token;
        
        Twocheckout::verifySSL(false);  // this is set to true by default
        Twocheckout::sandbox(true);

        try {
            $charge = TwocheckoutCharge::auth(array(
                "sellerId" => env('2CHECKOUT_SELLER_ID'),
                "merchantOrderId" => $request->plan_id,
                "token" => $token,
                "currency" => 'USD',
                "total" => $plan->price,
                "billingAddr" => array(
                    "name" => $request->first_name.' '.$request->last_name,
                    "addrLine1" => $request->address_1,
                    "city" => $request->city,
                    "state" => $request->state,
                    "zipCode" => $request->postal_code,
                    "country" => $request->country,
                    "email" => $request->email,
                    "phoneNumber" => $request->phone
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
                Payment::create(['place_id' => $this->place->id, 'amount' => $plan->price]);

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
        //TODO //will make some changes
        if($plan_id !=2){
            return redirect('admin/payment/subscribe');
        }
        $plan = Plan::find($plan_id);

        $billing_details = Auth::guard('admin')->user()->billing_details;

        $countries = CountryState::getCountries();
        if($billing_details)
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

    /**
     * Get states for given country
     *
     * @param $country
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStates($country){
        $states = CountryState::getStates($country);
        return response()->json($states);
    }
}
