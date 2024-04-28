<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function message_favorites()
    {
        return $this->hasMany(Message_Favorite::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class,'message_id')->whereNull('parent_id');
    }
}
