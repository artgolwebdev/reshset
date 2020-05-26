<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewComment implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $to;
    public $postId;
    public $comment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($to,$postId,$comment)
    {
        $this->to = $to ; 
        $this->postId = $postId;
        $this->comment = $comment;
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
            "comment"=>$this->comment,
            'post_id' => $this->postId
        ];
    }
}
