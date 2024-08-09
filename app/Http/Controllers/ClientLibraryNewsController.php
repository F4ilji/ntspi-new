<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientLibraryPostListResource;
use App\Models\LibraryNews;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientLibraryNewsController extends Controller
{
    public function index()
    {
        $posts = ClientLibraryPostListResource::collection(LibraryNews::query()
            ->where('is_active', true)
            ->orderBy('id', 'desc')
            ->paginate(6));
        return Inertia::render('Client/Library-news/Index', compact('posts'));
    }

    public function show(string $id)
    {
        $post = new ClientLibraryPostListResource(LibraryNews::query()->find($id));
        return Inertia::render('Client/Library-news/Show', compact('post'));
    }
}
