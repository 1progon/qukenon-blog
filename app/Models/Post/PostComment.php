<?php

namespace App\Models\Post;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
