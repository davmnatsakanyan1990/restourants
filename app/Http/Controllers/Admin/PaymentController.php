<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Lib\Twocheckout\TwocheckoutCharge;
use App\Http\Controllers\Admin\Lib\Twocheckout;
use App\Http\Controllers\Admin\Lib\Twocheckout\Api\TwocheckoutError;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show(){

    }

    public function edit(){
        return view('admin.update_billing_details');
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
                return response()->json(['success' => 1,'message' => 'Thanks for Subscribing!']);
            }
        } catch (Twocheckout_Error $e) {
            return response()->json(['success' => 0,'message' => 'Something went wrong.Please try again.']);
        }
    }
}
