<?php

namespace App\Http\Controllers;

use App\Tag;
use Exception;
use Illuminate\Http\Request;
use Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {

        $groups = Tag::latest()->get()->unique('group');

        return view('user-admin.tag.add-tag', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
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
        $tag->fill($request->all());


        $tag->save();

        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Tag $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Tag $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Tag $tag)
    {

        $groups = Tag::latest()->get()->unique('group');

        return view('user-admin.tag.edit-tag', compact('tag', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Tag $tag
     * @return \Illuminate\Http\RedirectResponse
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

        $tag->fill($request->all());
        $tag->save();

        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Tag $tag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tag $tag)
    {
        $tag->posts()->sync([]);
        $tag->delete();


        return redirect()->route('tag.index');
    }
}
