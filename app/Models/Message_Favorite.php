<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message_Favorite extends Model
{
    protected $table = 'message_favorites';
    use HasFactory;

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
