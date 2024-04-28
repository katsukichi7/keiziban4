<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Post;
use App\Models\Message;
use App\Models\Category;
use App\Models\Reply;
use App\Models\Reply_Favorite;

class ReplyController extends Controller
{
    public function create(Post $post, Message $message, Reply $reply,)
    {
        $replies = $message->replies()->get();

        return view('replies.create', compact('post', 'message', 'reply', 'replies'));
    }

    public function store(Request $request, Post $post, Reply $reply)
    {

        $maxMessageSerial = $post->messages()->max('serial_number') ?? 0;
        $maxReplySerial = Reply::where('post_id', $post->id)->max('serial_number') ?? 0;

        $maxSerial = max($maxMessageSerial,$maxReplySerial);

        $newSerial = $maxSerial + 1;

        $reply = new Reply();
        $reply->name = $request->input('name');
        $reply->content = $request->input('content');
        $reply->post_id = $request->input('post_id');
        $reply->message_id = $request->input('message_id');
        if ($request->has('parent_id')) {
            $reply->parent_id = $request->input('parent_id');
        }
        $reply->serial_number = $newSerial;
        $reply->save();

        return redirect()->route('posts.show', ['post' => $reply->post_id, 'reply' => $reply->id]);
    }

    public function show(Post $post, Message $message, Reply $reply, Request $request)
    {
        $replies = $message->replies;
        $request = request();
        $ip = $request->ip();
        $reply_favorite = Reply_Favorite::where('reply_id', $reply->id)->where('ip', $ip)->first();
        $childReplies = Reply::where('parent_id', $reply->id)->get();

        $messages = $post->messages()->get();

        if ($post->category_id !== null) {
            $category = Category::find($post->category_id);
        }

        $categories = Category::all()->sortBy('major_category_name');
        $major_category_names = Category::pluck('major_category_name')->unique();
        return view('replies.show', compact('post', 'message', 'replies', 'childReplies', 'categories', 'category', 'major_category_names', 'reply_favorite', 'reply'));
    }

    public function showChildReply(Post $post, Message $message, Reply $reply, $childReply)
    {
        if ($childReply) {

            $targetReply = Reply::findOrFail($childReply);
            $childReplies = $targetReply->childReplies;
        }

        return view('replies.showChildReplies', compact('childReplies'));
    }



    // メッセージに関連するトップレベルのリプライを取得
    /*public function showTopLevelReplies($messageId)
    {
        // 特定のメッセージに関連するトップレベルのリプライを取得
        $replies = Reply::where('message_id', $messageId)
            ->whereNull('parent_id')
            ->get();

        return view('replies.index', ['replies' => $replies]);
    }

    // リプライに関連する子リプライを表示
    public function showChildReplies($replyId)
    {
        $reply = Reply::find($replyId);
        if ($reply) {
            $childReplies = $reply->childReplies;
            return view('replies.show', ['reply' => $reply, 'childReplies' => $childReplies]);
        } else {
            return abort(404, "リプライが見つかりません");
        }
    }*/
}
