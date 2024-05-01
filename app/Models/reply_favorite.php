<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply_Favorite extends Model
{
    protected $table = 'message_favorites';
    use HasFactory;

    public function reply(){
        return $this->belongsTo(Reply::class);
    }
}