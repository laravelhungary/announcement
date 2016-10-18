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
    public function __construct(string $title, string $message, string $type, int $ttl, string $transition, string $channel_name)
    {
        $this->data = [
            'title'      => $title,
            'message'    => $message,
            'type'       => $type,
            'transition' => $transition,
            'ttl'        => $ttl,
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
        if ($this->channel_name) {
            return new Channel($this->channel_name);
        }

        return new Channel(config('announcement.broadcasting_channel'));
    }
}
