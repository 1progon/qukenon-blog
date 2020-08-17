<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post\PostImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param PostImage $postImages
     * @return void
     */
    public function show(PostImage $postImages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PostImage $postImages
     * @return void
     */
    public function edit(PostImage $postImages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PostImage $postImages
     * @return void
     */
    public function update(Request $request, PostImage $postImages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostImage $postImages
     * @return void
     */
    public function destroy(PostImage $postImages)
    {
        //
    }


    /**
     * Используется для удаления ошибочных фото в route error.images
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function removeErrorImages(Request $request)
    {

        Storage::delete($request->images_to_remove);

        return redirect()->route('error.images');
    }
}
