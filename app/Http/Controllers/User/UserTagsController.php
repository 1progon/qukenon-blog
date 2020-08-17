<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tag\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserTagsController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|JsonResponse|View
     */
    public function index(Request $request)
    {

        if ($request->has('filter')) {
            $filter = $request->query('filter');
            if (!$filter) {
                return response()->json(['status' => 'ERROR', 'message' => 'Empty filter'], 400);

            }


            $tags = Tag::where('name', 'like', '%' . $filter . '%')
                ->orWhere('group', 'like', '%' . $filter . '%')
                ->latest()
                ->withCount('posts')
                ->with(['posts' => function (BelongsToMany $query) {
                    return $query->get(['id', 'title']);
                }])->get();


            return response()->json($tags);
        }


        $tags = Tag::latest()->paginate();

        return view('user-admin.tag.index', compact('tags'));
    }
}
