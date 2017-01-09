<?php

namespace App\Http\Controllers\GroupAdmin\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $guard = 'group_admin';
    protected $username = 'username';
    protected $loginView = 'group_admin.auth.login';
    protected $redirectTo = 'group_admin/dashboard';
    protected $redirectAfterLogout = 'group_admin/login';

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest:group_admin', ['except' => ['logout']]);
    }
}
