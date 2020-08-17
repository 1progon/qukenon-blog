<?php

namespace App\Models\Category;

use App\Models\Post\Post;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        "slug", "title", "description", "image", "main_bar", "user_id", "meta_keys"
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
