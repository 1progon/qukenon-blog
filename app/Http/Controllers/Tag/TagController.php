<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag\Tag;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {

        $groups = Tag::latest()->get()->unique('group');

        return view('user-admin.tag.add-tag', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Factory|RedirectResponse|View
     */
    public function store(Request $request)
    {

        if (!$request->slug) {
            $request->merge(['slug' => Str::slug($request->name, '-')]);
        }

        if (!$request->group) {
            $request->merge(['group' => 'default']);
        }

        $validated = $request->validate([
            'slug' => 'bail|required|unique:tags,slug|min:3',
            'name' => 'bail|required|min:3',
            'group' => 'required|min:3'
        ], [
            'min' => 'Длина минимум :min',
            'required' => 'Поле обязательно для заполнения',
            'unique' => 'Уже есть такой в базе'
        ]);

        $tag = new Tag();
        $tag->fill($validated);


        $tag->save();

        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return Application|Factory|Response|View
     */
    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return Application|Factory|Response|View
     */
    public function edit(Tag $tag)
    {

        $groups = Tag::latest()->get()->unique('group');

        return view('user-admin.tag.edit-tag', compact('tag', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function update(Request $request, Tag $tag)
    {

        $validated = $request->validate([
            'slug' => 'bail|required|unique:tags,slug,' . $tag->id . '|min:3',
            'name' => 'bail|required|min:3',
            'group' => 'required|min:3'
        ], [
            'min' => 'Длина минимум :min',
            'required' => 'Поле обязательно для заполнения или выбора',
            'unique' => 'Уже есть такой в базе'
        ]);

        $tag->fill($validated);
        $tag->save();

        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Tag $tag)
    {
        $tag->posts()->sync([]);
        $tag->delete();


        return redirect()->route('tag.index');
    }
}
