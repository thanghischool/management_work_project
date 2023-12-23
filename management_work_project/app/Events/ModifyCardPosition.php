<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Card;

class ModifyCardPosition implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    // public $index, $list_ID, $card_ID;
    // public $project;
    public $card, $project_ID;
    // public function __construct(Project $project, $index, $list_ID, $card_ID)
    // {
    //     $this->index = $index;
    //     $this->list_ID = $list_ID;
    //     $this->card_ID = $card_ID;
    //     $this->project = $project;
    // }
    public function __construct($project_ID, Card $card)
    {
        $this->card = $card;
        $this->project_ID = $project_ID;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel('project.'.$this->project_ID);
    }
}
