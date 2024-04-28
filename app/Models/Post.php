<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }
}
