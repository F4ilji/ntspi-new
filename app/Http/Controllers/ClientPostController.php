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
    public function __invoke($slug)
    {
        $mainSections = MainSectionResource::collection(MainSection::all());
        $post = new PostResource(Post::where('slug', $slug)->firstOrFail());
        return Inertia::render('Client/Posts/Show', compact('post', 'mainSections'));
    }

}
