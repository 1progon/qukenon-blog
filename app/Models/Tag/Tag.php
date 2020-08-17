<?php

namespace App\Models\Tag;

use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = ['name', 'slug', 'description', 'group'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class,'post_tag', 'tag_id', 'post_id');
    }
}
