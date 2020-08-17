<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
