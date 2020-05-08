<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Post;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function feed($user_id)
    {
        $friends = Auth::user()->friends();
        $profile = Auth::user()->posts;

        $feed = [];
        foreach($friends as $friend){
            foreach($friend->posts as $post){
                array_push($feed,$post);
            }
        }
        foreach($profile as $post){
            array_push($feed,$post);  
        }
        // overwrite feed array 
        // if we got param user_id to fetch feed for profile 
        if($user_id != 0){
            $feed = Post::where('user_id',$user_id)->get();
        }
        
        
        // order by id of post
        //usort($feed,function($a,$b){
        //    return $a['id'] < $b['id'];
        //});

        return $feed;
    }

    public function getsinglepost($id)
    {
        $feed = Post::where('id',$id)->get();
        return $feed;
    }
}
