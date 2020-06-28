<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Classes\ImageResizer;
use App\Post;
use App\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use stdClass;

class PostsController extends Controller
{

    private string $imagesFolder;

    const THUMB = [
        'smallest' => ['w' => 80, 'h' => 80, 'str' => '80_80'],
        'small' => ['w' => 256, 'h' => 144, 'str' => '256_144'],
        'middle' => ['w' => 720, 'h' => 405, 'str' => '720_405'],
        'maximum' => ['w' => 1140, 'h' => 0, 'str' => '1140_0'],
    ];


    public function __construct()
    {
        $this->imagesFolder = 'post-images/' . date('Y' . '/' . date('m'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return view('post.index', compact('posts'));
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
        $category = Category::find($request->category_id);

        $post = new Post();

        $post->user_id = Auth::id();

        $post->fill($request->except('images'));

        $category->posts()->save($post);


        // Resize, create thumbs and save all images from upload
        if ($request->hasFile('images')) {
            $this->resizeUploadedImages($request, $post);
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
        $category = Category::find($request->category_id);

        $post->fill($request->except(['images', 'remove_images']));

        $category->posts()->save($post);

        if ($request->has('remove_images')) {

            $imagesBeforeUpload = $post->images;

            // Remove old selected images
            foreach ($request->remove_images as $imageId) {

                $image = $imagesBeforeUpload->find($imageId);


                $this->deleteImagesFilesFromFolder($image);


                $image->delete();

            }
        }

        // Resize, create thumbs and save all images from upload
        if ($request->hasFile('images')) {
            $this->resizeUploadedImages($request, $post);
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

        $images = $post->images;


        if ($images) {
            foreach ($images as $image) {

                // Delete image file from folder and thumbnails

                $this->deleteImagesFilesFromFolder($image);
            }
        }


        $post->delete();

        return redirect()->route('post.index');
    }


    private function resizeUploadedImages(Request $request, Post $post)
    {
        $images = $request->file('images');
        foreach ($images as $image) {
            $postImage = new PostImage();


            // Save uploaded image to folder
            $path = $image->store($this->imagesFolder);

            // Filename without extension
            $fileName = File::name($path);
            $newExtension = 'jpg';


            $resizer = new ImageResizer();

            // Scale Main image and get new path of it, because old image removed
            $path = $resizer->scaleMainImage($path);


            $resizer->createThumb($path, self::THUMB['smallest']);

            $resizer->createThumb($path, self::THUMB['small']);


            // Add main image to DB
            $postImage->filename = $fileName . '.' . $newExtension;
            $postImage->folder = $this->imagesFolder;
            $post->images()->save($postImage);


        }
    }


    private function deleteImagesFilesFromFolder($image)
    {
        Storage::delete($image->folder . '/' . $image->filename);

        foreach (self::THUMB as $size) {
            Storage::delete($image->folder . '/' . $size['str'] . '_' . $image->filename);
        }


    }
}
