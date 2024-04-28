<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Message_Favorite;
use App\Models\Message;
use App\Models\Reply_Favorite;
use App\Models\Reply;
use Illuminate\Support\Collection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        // $posts=Post::orderBy('created_at','asc')->take(10)->get();

        if ($request->category !== null) {
            $posts = Post::where('category_id', $request->category)->get();
            $category = Category::find($request->category);
        } elseif ($keyword !== null) {
            $posts = Post::where('name', 'like', "%{$keyword}%")->get();
            $category = null;
        } else {
            $posts = Post::orderBy('created_at', 'desc')->take(10)->get();
            $category = null;
        }



        $categories = Category::all()->sortBy('major_category_name');
        $major_category_names = Category::pluck('major_category_name')->unique();
        return view('posts.index', compact('posts', 'category', 'major_category_names', 'categories', 'keyword'));
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
        $post = new Post();
        $post->name = $request->input('name');
        $post->category_id = $request->input('category_id');
        $post->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, Post $post, Request $request, Message $message, Reply $reply)
    {
        $messages = $post->messages()->get();
        $keyword = $request->keyword;
        $replies = $message->replies()->get();
        $request = request();
        $ip = $request->ip();
        $message_favorite = Message_Favorite::where('message_id', $message->id)->where('ip', $ip)->first();
        $posts = Post::where('category_id', $category->id)->get();

        $childReplies = $reply->childReplies;

        $allItems = collect();

        foreach ($post->messages as $message) {
            $allItems->push($message);


            foreach ($message->replies as $reply) {
                $allItems->push($reply);

                foreach ($reply->childReplies as $childReply) {
                    $allItems->push($childReply);

                    foreach ($childReply->childReplies as $childReply) {
                        $allItems->push($childReply);
                    }
                }
            }
        }

        $sorted = $allItems->sortBy('created_at');


        if ($post->category_id !== null) {
            $category = Category::find($post->category_id);
        }

        $categories = Category::all()->sortBy('major_category_name');
        $major_category_names = Category::pluck('major_category_name')->unique();
        return view('posts.show', compact('post', 'messages', 'categories', 'major_category_names', 'category', 'message_favorite', 'replies', 'sorted'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
