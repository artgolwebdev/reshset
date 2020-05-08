<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $this->validate($request,[
            'target' => 'required'
        ]);

        $user_results = User::where('name','like', '%' . $request->input('target') . '%')
                        ->orWhere('email','like', '%' .  $request->input('target') . '%')
                        ->get();

        $posts_results = Post::where('content','like', '%' . $request->input('target') . '%')->get();

        return response()->json([
            'user_results' => $user_results , 
            'posts_results' => $posts_results
        ]);
    }
}
