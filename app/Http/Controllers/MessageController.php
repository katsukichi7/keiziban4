<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Favorite;
use App\Models\Reply;

class MessageController extends Controller
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
    public function create(Post $post)
    {
        $message = new Message();

        return view('messages.create', compact('post', 'message'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post,Reply $reply)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required'
        ]);

        $maxMessageSerial = Message::where('post_id', $post->id)->max('serial_number') ?? 0;
        $maxReplySerial = Reply::where('post_id', $post->id)->max('serial_number') ?? 0;


        $maxSerial = max($maxMessageSerial, $maxReplySerial);  // 両方の最大値から大きい方を選択
        $newSerial = $maxSerial + 1;

        $message = new Message();
        $message->name = $request->input('name');
        $message->content = $request->input('content');
        $message->post_id = $request->input('post_id');
        $message->serial_number = $newSerial;
        $message->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
