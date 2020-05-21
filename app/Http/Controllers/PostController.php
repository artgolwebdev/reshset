<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Comment;
use App\User;
use App\Events\NewPost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $_post =  Post::create([
            'user_id' => Auth::id() , 
            'content' => $request->input('content')
        ]);

        $post = Post::find($_post->id);

        $friends = Auth::user()->friends();
        foreach($friends as $friend){
            event(new NewPost($friend->id,$post));
        }

        return $post;
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
