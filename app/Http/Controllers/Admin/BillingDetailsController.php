<?php

namespace App\Http\Controllers\Admin;

use App\Models\BillingDetails;
use CountryState;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BillingDetailsController extends Controller
{

    public $admin;
    
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->admin = Auth::guard('admin')->user();
    }

    /**
     * Show Billing details form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(){
        $billing_details = $this->admin->billing_details;
        $countries = CountryState::getCountries();

        if($billing_details)
            $states = CountryState::getStates($billing_details->country);
        else
            $states = [];
        
        return view('admin.update_billing_details', compact('billing_details', 'countries', 'states'));
    }

    /**
     * Create or Update Admin Billing details
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'time_zone' => 'required',
            'postal_code' => 'required'
        ]);

        $data = $request->all();

        if(is_null($this->admin->billing_details)){
            $data['admin_id'] = $this->admin->id;
            // create new data
            BillingDetails::create($data);
            return redirect()->back()->with('message', 'Your data has successfully saved');
        }
        else{
            //update existing data
            BillingDetails::where('admin_id', $this->admin->id)->update($request->all());
            return redirect()->back()->with('message', 'Your data has successfully updated');
        }
    }
}
