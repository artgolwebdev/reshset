<?php

namespace App\Events;

use App\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

// ShouldBroadcast do not forget !!! 

class NewPost implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $to;
    public $post;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($to,$post)
    {
        $this->to = $to ;
        $this->post = $post;   
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
            "post"=>$this->post
        ];
    }
}
