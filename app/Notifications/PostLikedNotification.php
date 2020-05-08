<?php

namespace App\Notifications;

use Auth;
use App\Like;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;


class PostLikedNotification extends Notification
{
    use Queueable;

    public $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast','database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {       
            $data = Like::where("post_id",$this->post->id)->where("user_id",Auth::id())->get();
            return [
                'name' => Auth::user()->name,
                'message' => 'liked your <a href="'.route('post',$this->post->id).'">post</a>.',
                'slug' => Auth::user()->slug , 
            ];
    }

}
