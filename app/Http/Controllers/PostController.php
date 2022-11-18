<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['posts'] = Post::orderBy('id', 'desc')->get();
        return view('posts.index')->with($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.add-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => ['required'],
            'featured_image' => ['required','image','mimes:jpg,jpeg,png,gif','max:2048'],
            'description' => ['required'],
        ]);
        
        $image_name = "";
        if($image = $request->file('featured_image')) {
            $name = $image->getClientOriginalName();
            if(file_exists(public_path('storage/').$name)){
                return response()->json(['sts' => false, 'msg' =>['featured image exists already']]);
            }
            $image->move(public_path('storage/'), $name);
            $img_name = $name;
            $post = Post::savePost($request->all() ,$img_name);
            if($post){
                return redirect('/posts');
            }else{
                return back()->withErrors([
                    'post_error' => 'Unable to insert post please try again!',
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $id)
    {
        if(!is_null($id)){
            $result['post'] = Post::find($id);
            return view('posts.view-post')->with($result);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Request $request)
    {
       $result['post'] = Post::find($request->id);
       return view('posts.edit-post')->with($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
        ]);

        $image_name = $request->image_name;
        if($image_name==""){
            $validator = $request->validate([
                'featured_image' => ['required','image','mimes:jpg,jpeg,png,gif','max:2048'],
            ]);
        }

        if($image = $request->file('featured_image')) {
            $name = $image->getClientOriginalName();
            if(file_exists(public_path('storage/').$name)){
                return response()->json(['sts' => false, 'msg' =>['featured image exists already']]);
            }
            $image->move(public_path('storage/'), $name);
            $image_name = $name;
        }
        
        $post = Post::updatePost($request->all() ,$image_name);
        if($post){
            return redirect('/posts');
        }else{
            return back()->withErrors([
                'post_error' => 'Unable to insert post please try again!',
            ]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Request $request)
    {
        $post = Post::find($request->id);
        if($post){
            unlink("storage/".$post->featured_image);
            $delete = Post::where('id', $post->id)->delete();
            if($delete){
                return redirect('/posts');
            }else{
                return back()->withErrors([
                    'post_error' => 'Unable to delete post please try again!',
                ]);
            }
        }
    }
}
