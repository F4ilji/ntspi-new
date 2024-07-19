<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\AuthorPost;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = CategoryResource::collection(Category::query()
            ->when(request()->input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(request()->input('perPage', 9))
            ->withQueryString());
        $filters = [
            'search' => request()->input('search'),
        ];
        return Inertia::render('AdminPanel/Categories/Index', compact('categories', 'filters'));
    }

    public function create()
    {
        return Inertia::render('AdminPanel/Categories/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories|max:50|min:5',
        ]);
        Category::create($data);
        return redirect()->route('admin.category.index');
    }

    public function edit(Category $category)
    {
        return Inertia::render('AdminPanel/Categories/Edit', compact('category'));
    }

    public function update(Category $category, Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories|max:50|min:5',
        ]);
        $category->update($data);
        return redirect()->route('admin.category.index');
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('admin.category.index');
    }

}
