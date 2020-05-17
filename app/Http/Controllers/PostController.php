<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Comment;
use App\User;
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

    public function addcomment(Request $request)
    {
        $comment = Comment::create([
            'user_id' => Auth::id() , 
            'post_id' => $request->input('post_id') , 
            'comment' => $request->input('comment')
        ]);
        
        $post = Post::where('id',$request->input('post_id'))->first();
        if(Auth::id()!=$post->user->id)User::find($post->user->id)->notify(new \App\Notifications\CommentAdded($comment));

        return Comment::find($comment->id);
    }
}
