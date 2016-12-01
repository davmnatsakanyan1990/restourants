<?php

namespace App\Console;

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
            $places = Place::whereNotNull('first_login')->where('plan_id', 1)->get()->toArray();

            // get current date time in Unix format
            $now = strtotime(date("Y-m-d H:i:s"));

            foreach($places as $place){

                //get email sent time in Unix format
                $activation_date = strtotime($place['first_login']);

                // deactivate place after 5 day
                if($now > $activation_date + 432000){
                    Place::where('id', $place['id'])->delete();
                }
            }
        })->daily();
    }
}
