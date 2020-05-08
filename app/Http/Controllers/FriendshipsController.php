<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class FriendshipsController extends Controller
{
    public function check($id)
    {
        if(Auth::user()->id == $id){
            return ["status" => "friends"];
        }
        if(Auth::user()->is_frineds_with($id) === 1)
        {
            return ["status" => "friends"];
        }

        if(Auth::user()->has_pending_frined_request_from($id) === 1)
        {
            return ["status" => "pending"];
        }

        if(Auth::user()->has_pending_frined_request_to($id) === 1)
        {
            return ["status" => "waiting"];
        }
        return ["status"=>0];
    }

    public function add_friend($id)
    {   
       // sending notifications , emails , broadcasting 
       $response =  Auth::user()->add_friend($id);

       User::find($id)->notify(new \App\Notifications\NewFriendRequest(Auth::user()));

       return $response;
    }

    public function accept_friend($id)
    {
        // sending notifications , emails , broadcasting 
        $response =  Auth::user()->accept_friend($id);

        User::find($id)->notify(new \App\Notifications\FriendRequestAccepted(Auth::user()));

        return $response;
    }

    public function getfrineds($user_id)
    {
        return User::find($user_id)->friends();
    }
}
