<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\PostImage;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('post.index', ['posts' => Post::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        $categories = Category::all();
        return view('user-admin.post.add-post', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $category = Category::firstWhere('id', '=', $request->category_id);

        $post = new Post();

        $post->user_id = Auth::id();

        $post->fill($request->except('images'));

        $category->posts()->save($post);

        $images = $request->file('images');
        foreach ($images as $image) {
            $postImage = new PostImage();


            $path = $image->store('post-images/'
                . date('Y' . '/' . date('m')));

            $postImage->filePath = $path;

            $post->images()->save($postImage);
        }

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        $images = $post->images;

        $firstImage = Arr::pull($images, 0);


        return view('post.show', compact('post', 'firstImage', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('user-admin.post.edit-post', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $category = Category::firstWhere('id', '=', $request->category_id);

        $post->fill($request->except(['images', 'remove_images']));

        $category->posts()->save($post);

        if ($request->has('remove_images')) {

            $imagesBeforeUpload = $post->images;

            // Remove old selected images
            foreach ($request->remove_images as $imageId) {

                $image = $imagesBeforeUpload->firstWhere('id', '=', $imageId);


                Storage::delete($image->filepath);

                $image->delete();

            }
        }

        // Save new uploaded images
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $postImage = new PostImage();


                $path = $image->store('post-images/'
                    . date('Y' . '/' . date('m')));

                $postImage->filePath = $path;

                $post->images()->save($postImage);
            }
        }


        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        foreach ($post->images as $image) {

            Storage::delete($image->filepath);
        }

        $post->delete();

        return redirect()->route('post.index');
    }
}
