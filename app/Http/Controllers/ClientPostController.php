<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ClientNavigationResource;
use App\Http\Resources\ClientPostListResource;
use App\Http\Resources\MainSectionResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\MainSection;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientPostController extends Controller
{
    public function index(Request $request)
    {
        $navigation = ClientNavigationResource::collection(MainSection::with('subSections.pages')->orderBy('sort', 'asc')->get());
        $categories = CategoryResource::collection(Category::has('posts')->get());
        $posts = ClientPostListResource::collection(Post::query()
            ->select('title', 'slug', 'authors', 'category_id', 'preview', 'search_data', 'created_at')
            ->where('status', '=', 'published')->with('category')
            ->when(request()->input('search'), function ($query, $search) {
                $query->whereRaw('LOWER(title) like ?', ["%".strtolower($search)."%"]);
            })
            ->when(request()->input('category'), function ($query, $category_id) {
                $query->where('category_id', $category_id);
            })
            ->orderBy('id', 'desc')
            ->paginate(6)
            ->withQueryString());
        $filters = [
            'search' => request()->input('search'),
            'category_id' => request()->input('category')
        ];
        return Inertia::render('Client/Posts/Index', compact('navigation','filters', 'posts', 'categories'));
    }

    public function show($slug)
    {
        $navigation = ClientNavigationResource::collection(MainSection::with('subSections.pages')->orderBy('sort', 'asc')->get());
        $post = new PostResource(Post::where('slug', $slug)->firstOrFail());
        return Inertia::render('Client/Posts/Show', compact('post', 'navigation'));
    }



}
