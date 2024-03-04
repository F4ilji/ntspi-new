<?php

namespace App\Http\Controllers;

use App\Http\Resources\MainSectionResource;
use App\Http\Resources\PostResource;
use App\Models\MainSection;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientPostController extends Controller
{
    public function index()
    {
        $mainSections = MainSectionResource::collection(MainSection::all());
        $posts = PostResource::collection(Post::query()->orderBy('id', 'desc')->paginate());
        return Inertia::render('Client/Posts/Index', compact('mainSections', 'posts'));
    }

    public function show($slug)
    {
        $mainSections = MainSectionResource::collection(MainSection::all());
        $post = new PostResource(Post::where('slug', $slug)->firstOrFail());
        return Inertia::render('Client/Posts/Show', compact('post', 'mainSections'));
    }

}
