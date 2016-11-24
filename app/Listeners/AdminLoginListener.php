<?php

namespace App\Listeners;

use App\Events\AdminLoginEvent;
use App\Models\Place;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminLoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AdminLoginEvent  $event
     * @return void
     */
    public function handle(AdminLoginEvent $event)
    {
        $place = $event->admin->place;
        
        if(!is_null($place->sent_at)){
            Place::where('id', $place->id)->update(['first_login' => 1]);
        }
    }
}
