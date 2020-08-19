<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {

        $categories = Category::paginate();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('user-admin.category.add-category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $cat = new Category();

        $cat->fill($request->all());

        $user->categories()->save($cat);

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|RedirectResponse|View
     */
    public function show(Category $category)
    {

        if (!$category->posts()->count()) {
            return redirect()->route('error404');

        }

        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category)
    {
        return view('user-admin.category.edit-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category)
    {


        $category->fill($request->all());

        if (!isset($request->main_bar) || is_null($request->main_bar)) {
            $category->main_bar = 0;


        }

        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     * @throws Exception
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

        return redirect()->route('categories.index');
    }
}
