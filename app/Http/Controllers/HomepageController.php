<?php

namespace App\Http\Controllers;

use App\Post;

class HomepageController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable|void
     */
    public function index()
    {

        $stopShowFeatured = false;
        $posts = Post::latest()->paginate();

        if ($posts->count() < 1) {
            return abort(404);
        }

        if (request()->has('page') && request()->page > 1) {
            $stopShowFeatured = true;
        }

        $thumb = PostsController::THUMB;

        return view('homepage', compact('posts', 'stopShowFeatured', 'thumb'));
    }
}
