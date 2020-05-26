<?php

namespace App\Http\Controllers;

use Auth;
use App\Like;
use App\Post;
use App\User;
use App\Events\NewLike;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function like($id)
    {   
        $post = Post::find($id);
        $like =  Like::create([
            'user_id' => Auth::id() ,
            'post_id' => $post->id 
        ]);

        $fulllike = Like::find($like->id);

        if(Auth::id()!=$post->user->id){
            User::find($post->user->id)->notify(new \App\Notifications\PostLikedNotification($post));
            event(new NewLike($post->user->id,$post->id,$like));
        }
        

        return $fulllike;

    }

    public function unlike($id)
    {
        $post = Post::find($id);
        $like = Like::where('user_id',Auth::id())->where('post_id',$post->id)->first();
        $like->delete();
        return $like->id; 
    }
}
