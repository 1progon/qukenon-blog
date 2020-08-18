<?php

namespace App\Models\Post;

use App\Models\Category\Category;
use App\Models\Tag\Tag;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "category_id", "user_id", "slug", "title", "description", "article", "image", "meta_keys"
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function files()
    {
        return $this->hasMany(PostFile::class);
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag','post_id', 'tag_id');
    }

}
