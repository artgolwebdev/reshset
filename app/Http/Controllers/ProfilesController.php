<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use App\Post;
use Illuminate\Http\Request;
use Auth;
use Session;


class ProfilesController extends Controller
{
    public function index($slug)
    {
        $user = User::where('slug',$slug)->first();
        return view('profiles.profile')->with(['user'=>$user]); 
    }

    public function edit()
    {
        return view('profiles.edit')->with('profile',Auth::user()->profile);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'location' => 'required' ,
            'about' => 'required|max:250'
        ]);

        Auth::user()->profile()->update([
            'location' => $request->input('location') , 
            'about' => $request->input('about')
        ]);

        if($request->hasFile('avatar')){
            Auth::user()->update([
                'avatar' => $request->avatar->store('public/avatars')
            ]);
        }

        Session::flash('success','Profile updated');
        return redirect()->back();
    }
}
