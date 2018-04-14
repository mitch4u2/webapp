<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;    
use App\Like;

class CommentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);
        
        // CREATE COMMENT 
        $comment = new comment();
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $request->input('post_id');
        $comment->body = $request->input('body');
        $comment->save();

        return redirect('/posts/'.$comment->post_id)->with('success', 'Comment Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        // check for correct user
        if (auth()->user()->id !== $comment->user_id) {
            return redirect('/posts/'.$comment->post_id)->with('error', 'Unauthorized Page');
        }

        $comment->delete();
        return redirect('/posts/'.$comment->post_id)->with('success', 'Comment Removed');
    }



    public function likeComment(Request $request){
        $comment_id = $request['commentId'];
        $is_like = $request['islike'] === 'true';
        $update = false;
        $comment = Comment::find($comment_id);
        if(!$comment){
            return null;
        }
        $user = auth()->user();
        // look for user old interaction toward this comment
        $like = $user->likes()->where('comment_id',$comment_id)->first();
        // if user already interacted with this comment
        if($like){
            $already_like = $like->like_dislike;
            $update = true;
            // if user click on the same interaction
            if($already_like == $is_like){
                // remove his interaction
                $like->delete();
                return null;
            }
        }else{//if user never interacted with this comment
            // create a new like
            $like = new Like();
        }
        $like->like_dislike = $is_like;
        $like->user_id = $user->id;
        $like->comment_id = $comment->id;
        // if the comment needs to be updated or create a new one
        if($update){
            $like->update();
        }else{
            $like->save();
        }
        return null;
    }
}
