<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $categories = Category::paginate(15);
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('user-admin.category.add-category');
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

        $cat = new Category();


        $cat->fill($request->all());

        $user->categories()->save($cat);

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {

        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('user-admin.category.edit-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {


        $category->fill($request->all());

        if (!isset($request->main_bar) || is_null($request->main_bar)) {
            $category->main_bar = 0;


        }

        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {

        $user = Auth::user();

        $defaultCategory = Category::where('title', '=', 'default')
            ->orWhere('slug', '=', 'default')->first();


        if (!$defaultCategory) {
            $defaultCategory = new Category();
            $defaultCategory->title = 'Default';
            $defaultCategory->slug = 'default';
            $defaultCategory->slug = 'default';
            $defaultCategory->description = '';
            $user->categories()->save($defaultCategory);
        }


        $posts = $category->posts;
        foreach ($posts as $post) {
            $post->category_id = $defaultCategory->id;
            $post->save();
        }

        $category->delete();

        return redirect()->route('category.index');
    }
}
