<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    public function message(){
        return $this->belongsTo(Message::class);
    }

    public function reply_favorites(){
        return $this->hasMany(Reply_Favorite::class);
    }

    public function childReplies(){
        return $this->hasMany(Reply::class,'parent_id')->WhereNotNull('parent_id');
    }

    public function directRepliesCount(){
        return $this->childReplies()->count();
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
