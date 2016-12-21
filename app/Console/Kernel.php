<?php

namespace App\Console;

use App\Models\Payment;
use App\Models\Place;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
         Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $places1 = Place::whereNotNull('first_login')->where('plan_id', 1)->get()->toArray();

            // get current date time in Unix format
            $now = strtotime(date("Y-m-d H:i:s"));

            if(count($places1) > 0) {
                foreach ($places1 as $place) {

                    //get email sent time in Unix format
                    $activation_date = strtotime($place['first_login']);

                    // deactivate place after 5 day
                    if ($now > $activation_date + 432000) {
                        Place::where('id', $place['id'])->delete();
                    }
                }
            }

//            $places2 = Place::where('plan_id', 2)->get()->toArray();
//            foreach ($places2 as $place) {
//                $last_payment = Payment::where('place_id', $place['id'])->orderBy('created_at')->get()->last()->toArray();
//                $payment_date = strtotime($last_payment['created_at']);
//
//                // deactivate account after 1 year, if there is not new payment
//                if($now > $payment_date + 31536000){
//                    Place::where('id', $place['id'])->delete();
//                }
//            }
        })->daily();
    }
}
