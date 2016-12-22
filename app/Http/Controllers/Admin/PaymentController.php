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
        Twocheckout::privateKey(env('2CHECKOUT_PRIVATE_KEY'));
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
            ));
            if ($charge['response']['responseCode'] == 'APPROVED') {
                Payment::create(['place_id' => $this->place->id, 'amount' => $plan->price]);
                $this->place->update(['plan_id' => $plan->id]);

                if($this->place->trashed()){
                    $this->place->restore();
                }
//                return response()->json(['success' => 1,'message' => 'Thanks for Subscribing!']);
                return redirect()->back()->with('message', 'Thanks for Subscribing!');
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
        $this->validate($request,[
            'email' => 'required|email'
        ]);
       
        Mail::send('emails.enterprise', ['request' => $request], function ($m) use ($request) {
            $m->from($request->email, 'Look Restaurants Application');

            $m->to(env('SUPPORT_MAIL'))->subject('Enterprise');
        });
        
        return response()->json(['success'=>1]);
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
