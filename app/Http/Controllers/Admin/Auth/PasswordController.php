<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;


    protected $guard = 'admin';
    protected $linkRequestView = 'admin/auth/passwords/email';
    protected $resetView = 'admin/auth/passwords/reset';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->guestMiddleware();
    }

//    public function sendResetLinkEmail(Request $request){
////        $email = $request->email;
////        Place::where('email', $email)->first()
//    }
}
