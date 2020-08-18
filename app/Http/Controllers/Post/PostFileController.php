<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use App\Models\Post\PostFile;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Storage;

class PostFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param Post $post
     * @return Collection|null
     */
    public function store(Request $request, Post $post): ?Collection
    {
        $folder = 'post-files/' . date('Y' . '/' . 'm');
        $specFiles = $request->file('spec_files');

        foreach ($specFiles as $specFile) {
            $postFile = new PostFile();

            //Fill the PostFile model
            $postFile->fill(
                [
                    'name' => $post->id . '_' . $specFile->getClientOriginalName(),
                    'folder' => $folder
                ]
            );

            //Save in DB
            $saved = $post->files()->save($postFile);
            if (!$saved) {
                return null;
            }


            //Save on disk
            $stored = Storage::putFileAs($folder, $specFile, $postFile->name);
            if (!$stored) {
                return null;

            }

        }

        return $post->files;
    }

    /**
     * Display the specified resource.
     *
     * @param PostFile $postFile
     * @return void
     */
    public function show(PostFile $postFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PostFile $postFile
     * @return void
     */
    public function edit(PostFile $postFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PostFile $postFile
     * @return void
     */
    public function update(Request $request, PostFile $postFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostFile $postFile
     * @return void
     * @throws Exception
     */
    public function destroy(PostFile $postFile)
    {
        Storage::delete($postFile->folder . '/' . $postFile->name);
        $postFile->delete();
    }
}
