<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function notifications()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return view('nots')->with('nots',Auth::user()->notifications);
    }

    public function getFriendsByLocation()
    {
        $users = [];
        $users = User::where('country',Auth::user()->country)
                        ->where('id','!=',Auth::user()->id)->orderBy('id','desc')->limit(15)->get();
        $friends = Auth::user()->friends();
        
        foreach($users as $key => $user){
            foreach($friends as $friend){
                if($user->id == $friend->id){
                    $users->forget($key);
                }
            }
        }

        return $users;
    }

    public function notificationslist()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return Auth::user()->notifications;
    }

    public function markasreadall()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json("ok");
    }
    
    public function chatpage()
    {
        return view('profiles.chat');
    }

}
