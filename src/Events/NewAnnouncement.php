<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewAnnouncement implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $data;
    protected $channel_name;

    /**
     * Create a new event instance.
     */
    public function __construct($type, $title, $message, $ttl, $transition, $channel_name)
    {
        $this->data = [
            'type'       => $type,
            'title'      => $title,
            'message'    => $message,
            'ttl'        => $ttl,
            'transition' => $transition,
        ];

        $this->channel_name = $channel_name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->channel_name);
    }
}
