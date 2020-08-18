<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class PostFile extends Model
{

    protected $fillable = ['name', 'folder', 'post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
