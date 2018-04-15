<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;

class FavoritesController extends Controller
{
    public function store(Request $request)
    {   
        $post_id = $request['postId'];
        $user_id = auth()->user()->id;
        $user = auth()->user();
        // look for user old interaction toward this comment
        $favorite = $user->favorites()->where('post_id', $post_id)->first();
        // if user already put it as favorite then delete it
        if ($favorite) {
            $favorite->delete();
            return null;
        }else
        // CREATE COMMENT 
        $favorite = new Favorite();
        $favorite->user_id = $user_id;
        $favorite->post_id = $post_id;
        $favorite->save();
        return null;
    }
}
