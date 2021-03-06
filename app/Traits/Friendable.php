<?php 

namespace App\Traits;

use App\Friendship;

trait Friendable
{
  public function add_friend($user_requested_id)
  {
    if($this->id === $user_requested_id){
        return 0;
    }
    if($this->has_pending_frined_request_to($user_requested_id) === 1)
    {
        return "Already sent a friend request"; 
    }

    if($this->has_pending_frined_request_from($user_requested_id) === 1)
    {
        return $this->accept_friend($user_requested_id);
    }

    if($this->is_frineds_with($user_requested_id) === 1)
    {
        return "already friends";
    }

      $frinedship = Friendship::create([
          'requester' => $this->id , 
          'user_requested' => $user_requested_id
      ]);

      if($frinedship)
      {
          return 1;//response()->json($frinedship,200);
      }

      return 0;//response()->json('fail',501);
  }

  public function accept_friend($requester)
  {
      if($this->has_pending_frined_request_from($requester) === 0)
      {
        return 0;
      }
        $frinedship = Friendship::where('requester',$requester)->where('user_requested',$this->id)->first();
        if($frinedship)
        {
            $frinedship->update([
                'status' => 1
            ]);
            return 1;//response()->json('ok',200);
        }
        return 0;//response()->json('fial',501);
  }

  public function friends()
  {
      $friends = array();
      $f1 = Friendship::where('status',1)->where('requester',$this->id)->get();
      foreach($f1 as $frinedship)
      {
          array_push($friends,\App\User::find($frinedship->user_requested));
      }
      $friends2 = array();
      $f2 = Friendship::where('status',1)->where('user_requested',$this->id)->get();
      foreach($f2 as $frinedship)
      {
          array_push($friends2,\App\User::find($frinedship->requester));
      }
      return array_merge($friends,$friends2);
  }


  public function pending_friend_requests()
  {
      $users = array();

      $frinedships = Friendship::where('status',0)->where('user_requested',$this->id)->get();
      foreach($frinedships as $frinedship)
      {
          array_push($users,\App\User::find($frinedship->requester));
      }
      return $users;
  }


  public function pending_friend_requests_ids()
  {
      return collect($this->pending_friend_requests())->pluck('id')->toArray();
  }

  public function pending_friend_requests_sent()
  {
      $users = array();
      $friendships = Friendship::where('status',0)->where('requester',$this->id)->get();
      foreach($friendships as $friendship)
      {
          array_push($users,\App\User::find($friendship->user_requested));
      }
      return $users;
  }


  public function pending_friend_requests_sent_ids()
  {
      return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
  }

  public function friends_ids()
  {
      return collect($this->friends())->pluck('id')->toArray();
  }

  public function is_frineds_with($user_id)
  {
      if(in_array($user_id,$this->friends_ids()))
      {
          return 1;//response()->json('true',200);
      }
      else
      {
          return 0;//response()->json('false',200);
      }
  }

  public function has_pending_frined_request_from($user_id)
  {
      if(in_array($user_id,$this->pending_friend_requests_ids()))
      {
          return 1;//response()->json('true',200);
      }
      else
      {
          return 0;//response()->json('false',200);
      }
  }

  public function has_pending_frined_request_to($user_id)
  {
    if(in_array($user_id,$this->pending_friend_requests_sent_ids()))
    {
        return 1; //response()->json('true',200);
    }
    else
    {
        return 0; //response()->json('false',200);
    }
  }


}