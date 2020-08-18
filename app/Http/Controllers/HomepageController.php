<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Post\PostsController;
use App\Models\Post\Post;
use Illuminate\Contracts\Support\Renderable;

class HomepageController extends Controller
{

    /**
     * Show the application dashboard.
     * @return Renderable|void
     */
    public function index()
    {

        $stopShowFeatured = false;
        //TODO Hardcoded category remove
        $posts = Post::where('category_id', '!=', 12)->latest()->paginate();

        if (Post::count() < 1) {
            return abort(404);
        }

        if (request()->has('page') && request()->page > 1) {
            $stopShowFeatured = true;
        }

        $thumb = PostsController::THUMB;

        return view('homepage', compact('posts', 'stopShowFeatured', 'thumb'));
    }
}
