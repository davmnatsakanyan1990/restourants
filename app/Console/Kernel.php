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
            $places = Place::with('payment')->whereNotNull('sent_at')->has('payment', '==', null)->get()->toArray();

            // get current date time in Unix format
            $now = strtotime(date("Y-m-d H:i:s"));

            foreach($places as $place){

                //get email sent time in Unix format
                $email_sent_time = strtotime($place['sent_at']);

                // deactivate place
                if($now > $email_sent_time + 604800){
                    Place::where('id', $place['id'])->delete();
                }
            }
        })->daily();
    }
}
