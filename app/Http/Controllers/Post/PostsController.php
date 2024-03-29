<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Classes\ImageResizer;
use App\Models\Category\Category;
use App\Models\Post\Post;
use App\Models\Post\PostFile;
use App\Models\Post\PostImage;
use App\Models\Tag\Tag;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use ImagickException;

class PostsController extends Controller
{

    /**
     * @var string
     */
    private string $imagesFolder;

    const THUMB = [
        'smallest' => ['w' => 80, 'h' => 80, 'str' => '80_80'],
        'small' => ['w' => 256, 'h' => 144, 'str' => '256_144'],
        'small2' => ['w' => 320, 'h' => 180, 'str' => '320_180'],
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
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = Post::latest()->paginate();

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {

        $noCategories = false;
        $categories = Category::all();
        $tags = Tag::latest()->get();

        if ($categories->count() < 1) {
            $noCategories = true;
        }
        return view('user-admin.post.add-post', compact('categories', 'noCategories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        $category = Category::find($request->category_id);

        $post = new Post();

        $generateSlug = Str::slug($request->title, '-');

        $post->slug = $generateSlug;


        $postsExist = Post::where('slug', '=', $generateSlug)->count();


        if ($postsExist > 0) {
            $postsExist = Post::where('slug', 'like', $generateSlug . '-%')->count();

            $post->slug = $generateSlug . '-' . ($postsExist + 1);

        }


        $post->user_id = Auth::id();

        $post->fill($request->except(['images', 'slug', 'user_id']));

        $category->posts()->save($post);

        $post->tags()->sync($request->tags);


        // Resize, create thumbs and save all images from upload
        if ($request->hasFile('images')) {
            $this->resizeUploadedImages($request, $post);
        }

        //Files to upload
        if ($request->has('spec_files')) {
            $fileContr = new PostFileController();
            $res = $fileContr->store($request, $post);

            if (!$res) {
                //TODO Create error response
            }

        }

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|RedirectResponse|View
     * @throws Exception
     */
    public function show(Post $post)
    {


        //TODO Move hardcoded tag group and tag category to separate env constant
        if ($post->category()->first()->id === 12) {
            return redirect()
                ->route('tags.front.show',
                    [
                        $post->tags()
                            ->where('group', '=', 'download-minecraft-skins')
                            ->first()
                    ]);
        }

        $images = cache()->remember('post_images_' . $post->id,
            86400,
            function () use ($post) {
                return $post->images;
            });

        $firstImage = Arr::pull($images, 0);

        $comments = $post->comments;

        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where('category_id', '=', $post->category->id)
            ->inRandomOrder()
            ->limit(4)->get();

        $tags = $post->tags;


        return view('post.show',
            compact('post', 'comments', 'tags', 'relatedPosts', 'firstImage', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::latest()->get();
        return view('user-admin.post.edit-post', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request, Post $post)
    {

        $category = Category::find($request->category_id);

        $post->fill($request->except(['images', 'remove_images']));

        $post->tags()->sync($request->tags);

        $category->posts()->save($post);

        if ($request->has('remove_images')) {
            cache()->forget('post_images_' . $post->id);

            // Remove old selected images
            foreach ($request->remove_images as $imageId) {
                $image = PostImage::find($imageId);
                $this->deleteImagesFilesFromFolder($image);

                $image->delete();

            }
        }

        if ($request->has('remove_files')) {
            foreach ($request->remove_files as $fileId) {
                $postFile = PostFile::find($fileId);

                $ctrl = new PostFileController();
                $ctrl->destroy($postFile);
            }
        }

        // Resize, create thumbs and save all images from upload
        if ($request->hasFile('images')) {
            cache()->forget('post_images_' . $post->id);
            $this->resizeUploadedImages($request, $post);
        }

        //Files to upload
        if ($request->has('spec_files')) {
            $fileContr = new PostFileController();
            $res = $fileContr->store($request, $post);

            if (!$res) {
                //TODO Create error response
            }

        }


        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Post $post)
    {

        $images = $post->images;
        $files = $post->files;

        //Remove images from DB and disk
        if ($images) {
            foreach ($images as $image) {

                // Delete image file from folder and thumbnails
                $this->deleteImagesFilesFromFolder($image);
            }
        }

        //Remove files from DB and disk
        if ($files) {
            foreach ($files as $file) {
                $ctrl = new PostFileController();
                $ctrl->destroy($file);
            }

        }

        $post->tags()->sync([]);
        $post->delete();

        return redirect()->route('posts.index');
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
            try {
                $path = $resizer->scaleMainImage($path);
                $resizer->createThumb($path, self::THUMB['smallest']);
                $resizer->createThumb($path, self::THUMB['small']);
            } catch (ImagickException $e) {
            }

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
