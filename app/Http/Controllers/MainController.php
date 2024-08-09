<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientMainSliderResource;
use App\Http\Resources\ClientNavigationResource;
use App\Http\Resources\EventThumbnailResource;
use App\Http\Resources\MainSectionResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostThumbnailResource;
use App\Models\Event;
use App\Models\MainSection;
use App\Models\MainSlider;
use App\Models\Post;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class MainController extends Controller
{
    public function index()
    {
        $today = new DateTime();
        $event_date_start = $today->format('Y-m-d');
        $sliders = ClientMainSliderResource::collection(MainSlider::query()->where('is_active', true)->orderBy('sort', 'asc')->get());
        $posts = PostThumbnailResource::collection(Post::query()
            ->select('title', 'slug', 'authors', 'category_id', 'preview', 'search_data', 'created_at')
            ->with('category')
            ->where('status', '=', 'published')
            ->orderBy('id', 'desc')->limit(3)
            ->get());
        $events = EventThumbnailResource::collection(Event::query()
            ->select('title', 'slug', 'event_date_start', 'address', 'is_online', 'category_id')
            ->where('event_date_start', '>=', $event_date_start)
            ->orderBy('event_date_start', 'asc')->limit(3)->get());
        return Inertia::render('Main', compact('posts', 'events', 'sliders'));
    }
}
