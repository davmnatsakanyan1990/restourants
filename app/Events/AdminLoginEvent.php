<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AdminLoginEvent extends Event
{
    use SerializesModels;

    public $admin;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public function __construct($admin)
    {
        $this->admin = $admin;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
