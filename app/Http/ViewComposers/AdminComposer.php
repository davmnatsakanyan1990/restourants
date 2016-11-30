<?php

namespace App\Http\ViewComposers;


use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminComposer
{
    protected $admin;
    protected $days_remaining;

    /**
     * AdminComposer constructor.
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        $this->admin = Auth::guard('admin')->user();
        $this->days_remaining = $this->getRemainingTime();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('admin', $this->admin);
        $view->with('days_remaining', $this->days_remaining);
    }

    public function getRemainingTime(){
        $first_login = $this->admin->place->first_login;
        $days = ((strtotime($first_login)+432000) - strtotime(date("Y-m-d H:i:s")))/86400;
        if($days <= 0){
            return 0;
        }
        else{
            return round($days);
        }
    }
}