<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Message_Favorite;
use App\Models\Reply;
use App\Models\Reply_Favorite;

class FavoriteController extends Controller
{
    public function message_favorite(Message $message, Request $request)
    {
        $existingMessage_Favorite = Message_Favorite::where('message_id', $message->id)->where('ip', $request->ip())->first();

        if (!$existingMessage_Favorite) {
            $message_favorite = new Message_Favorite();
            $message_favorite->message_id = $message->id;
            $message_favorite->ip = $request->ip();
            $message_favorite->save();
        }
        // すでにいいねが存在する場合は削除
        if ($existingMessage_Favorite) {
            $existingMessage_Favorite->delete();
        }

        return back();

        
    }

    public function reply_favorite(Reply $reply, Request $request)
    {
        $existingReply_Favorite = Reply_Favorite::where('reply_id', $reply->id)->where('ip', $request->ip())->first();

        if (!$existingReply_Favorite) {
            $reply_favorite = new Reply_Favorite();
            $reply_favorite->reply_id = $reply->id;
            $reply_favorite->ip = $request->ip();
            $reply_favorite->save();
        }
        // すでにいいねが存在する場合は削除
        if ($existingReply_Favorite) {
            $existingReply_Favorite->delete();
        }

        return back();

        
    }

    /*public function unfavorite(Favorite $favorite, Request $request)
    {
        // $ip = $request->ip();
        // $favorite = Favorite::where('favorite_id', $favorite->id)->where('ip', $ip)->first();
        $favorite->delete();
        return back();
    }*/
}
