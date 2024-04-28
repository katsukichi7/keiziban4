<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reply_favorite extends Model
{
    use HasFactory;

    public function reply(){
        return $this->belongsTo(Reply::class);
    }
}