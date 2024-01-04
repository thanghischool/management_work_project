<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddPeople implements ShouldBroadcast
{
    use InteractsWithSockets;

    /**
     * Create a new event instance.
     */
    public $user_added_id;
    public $data;

    public function __construct($user_added_id, $data)
    {
        $this->user_added_id = $user_added_id;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('AddPeopleOnTeam.' . $this->user_added_id),
        ];
    }

   
}
