<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Models\Place;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Lib\Twocheckout\TwocheckoutCharge;
use App\Http\Controllers\Admin\Lib\Twocheckout;
use App\Http\Controllers\Admin\Lib\Twocheckout\Api\TwocheckoutError;
use Illuminate\Support\Facades\Auth;

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
        $is_subscribed = true;
        if(is_null($this->place->payment)){
            $is_subscribed = false;
        }
        return view('admin.subscribe', compact('is_subscribed'));
    }

    public function pay(Request $request)
    {
        Twocheckout::privateKey('0ED56256-9BBD-4363-B476-F51BC23ED009');
        Twocheckout::sellerId('901332804');

        $token = $request->token;
        
        Twocheckout::verifySSL(false);  // this is set to true by default
        Twocheckout::sandbox(true);

        try {
            $charge = TwocheckoutCharge::auth(array(
                "sellerId" => "901332804",
                "merchantOrderId" => "123",
                "token" => $token,
                "currency" => 'USD',
                "total" => '10.00',
                "billingAddr" => array(
                    "name" => 'Joe Flagster',
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
        return view('admin/checkout');
    }
}
