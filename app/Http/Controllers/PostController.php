<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $post =  Post::create([
            'user_id' => Auth::id() , 
            'content' => $request->input('content')
        ]);

        return Post::find($post->id);
    }

    public function show($id)
    {
        $postdata = Post::where('id',$id)->get()->toArray();
        return view('post')->with(["postdata"=>$postdata]);
    }
}
