<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewLike implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $to;
    public $postId;
    public $like;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($to,$postId,$like)
    {
        $this->to = $to;
        $this->postId = $postId;
        $this->like = $like;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.User.'.$this->to);
    }

    public function broadcastWith()
    {
        return [
                "like"=>$this->like,
                'post_id' => $this->postId
        ];
    }
}
