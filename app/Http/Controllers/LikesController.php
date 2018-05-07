<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LikePost;
use App\Post;
class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $post_id = $request['postId'];
        $is_like = $request['islike'] === 'true';
        // test
        // $user = auth()->user();
        // $like = new LikePost();
        // $like->like_dislike = $is_like;
        // $like->user_id = $user->id;
        // $like->post_id = $post_id;
        // $like->save();
        // return null;

        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $user = auth()->user();
        // look for user old interaction toward this post
        $like = $user->likeposts()->where('post_id', $post_id)->first();
        // if user already interacted with this post
        if ($like) {
            $already_like = $like->like_dislike;
            $update = true;
            // if user click on the same interaction
            if ($already_like == $is_like) {
                // remove his interaction
                $like->delete();
                return null;
            }
        } else {//if user never interacted with this post
            // create a new like
            $like = new LikePost();
             // if user like post first time increment 
        }
        $like->like_dislike = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post_id;
        // if the comment needs to be updated or create a new one
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        
        return null;
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
        //
    }
}
