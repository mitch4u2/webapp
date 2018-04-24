<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Comment;
use App\Like;

use Image;

class PostsController extends Controller
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
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            // 'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
        ]);
         // handle file upload
        if ($request->hasFile('cover_image')) {
            $cover_image = $request->file('cover_image');
            $filename = time() . '.' . $cover_image->getClientOriginalExtension();
            Image::make($cover_image)->resize(600,300)->save( public_path('/storage/cover_image/' . $filename));  
         }
         else {
            $filename = 'noimage.jpg';
        }
        // CREATE POST 
        $post = new post();
        // $post->title = $request->input('title');
        
        // $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filename;

        $post->body = $request->get('body');
        

        $post->save();


        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $comments = Comment::orderBy('id', 'desc')->where('post_id',$id)->get();
        $likes = Like::all(); 
        // var_dump($comments);
         return view('posts.show')->with('post', $post)->with('comments', $comments)->with('likes',$likes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        // check for correct user
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
        
         // handle file upload
         if ($request->hasFile('cover_image')) {
            $cover_image = $request->file('cover_image');
            $filename = time() . '.' . $cover_image->getClientOriginalExtension();
            Image::make($cover_image)->resize(600,300)->save( public_path('/storage/cover_image/' . $filename));  
         }
        // CREATE POST 
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if ($request->hasFile('cover_image')) {
            // delete old image
            if ($post->cover_image != 'noimage.jpg') {
                Storage::delete('public/cover_image/' . $post->cover_image);
            }
            $post->cover_image = $filename;
        }
        $post->save();
        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        // check for correct user
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        if ($post->cover_image != 'noimage.jpg') {
            // delete image
            Storage::delete('public/cover_image/' . $post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');

    }
}
