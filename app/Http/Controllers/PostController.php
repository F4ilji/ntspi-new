<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\GalleryResource;
use App\Http\Resources\PostResource;
use App\Models\AuthorPost;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Sleep;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support;
use Intervention\Image\ImageManagerStatic as ImageTool;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function index(Request $request)
    {
        $posts = PostResource::collection(Post::query()
            ->when(request()->input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(request()->input('perPage', 9))
            ->withQueryString());
        $filters = [
            'search' => request()->input('search'),
        ];

        return Inertia::render('AdminPanel/Posts/Index', compact('posts', 'filters'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryResource::collection(Category::all());
        return Inertia::render('AdminPanel/Posts/Create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title'], '-');
        $count = 0;
        $original_slug = $data['slug'];

        while (Post::where('slug', '=', $data['slug'])->exists()) {
            $count++;
            $data['slug'] = $original_slug . '-' . $count + 1;
        }


        $data['content'] = json_encode($data['content']);
        $data['reading_time'] = $this->calculateReadingTime($data['search_data']);
        $author = $data['author'];
        $images = $data['images'];
        unset($data['author']);
        unset($data['images']);

        $post = Post::create($data);
        if (isset($author)) {
            AuthorPost::create([
                'name' => $author,
                'post_id' => $post->id
            ]);
        }
        if (isset($images)) {
            $gallery = Gallery::create([
                'post_id' => $post->id,
            ]);
            foreach ($images as $image) {
                $filename = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . 'jpeg';

                ImageTool::configure(['driver' => 'imagick']);
                ImageTool::make($image)
                    ->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save(storage_path('app/public/images/' . $filename));
                $path = "/storage/images/" . $filename;
                Image::create([
                    'path' => $path,
                    'gallery_id' => $gallery->id,
                ]);
            }
        }

        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = new PostResource(Post::where('slug', $slug)->firstOrFail());
        return Inertia::render('AdminPanel/Posts/Show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = CategoryResource::collection(Category::all());
        $post = new PostResource($post);
        return Inertia::render('AdminPanel/Posts/Edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post, Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255|min:5',
            'content' => 'required|array',
            'content.blocks' => 'required|array|min:1',
            'category_id' => 'nullable|exists:categories,id',
            'is_published' => 'boolean',
        ]);
        $data['slug'] = \Illuminate\Support\Str::slug($data['title'], '-');
        $data['content'] = json_encode($data['content']);

        $post->update($data);
        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.post.index');
    }

    private function calculateReadingTime(string $text): int
    {

        $text = "lorem ipsum - это текст - часто используемый в печати и вэб-дизайне lorem ipsum является стандартной для текстов на латинице с начала xvi века в то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов используя lorem ipsum для распечатки образцов lorem ipsum не только успешно пережил без заметных изменений пять веков но и перешагнул в электронный дизайн его популяризации в новое время послужили публикация листов letraset с образцами lorem ipsum в 60-х годах и в более недавнее время программы электронной вёрстки типа aldus pagemaker в шаблонах которых используется lorem ipsum lorem ipsum - это текст - часто используемый в печати и вэб-дизайне lorem ipsum является стандартной для текстов на латинице с начала xvi века в то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов используя lorem ipsum для распечатки образцов lorem ipsum не только успешно пережил без заметных изменений пять веков но и перешагнул в электронный дизайн его популяризации в новое время послужили публикация листов letraset с образцами lorem ipsum в 60-х годах и в более недавнее время программы электронной вёрстки типа aldus pagemaker в шаблонах которых используется lorem ipsum";
        // Calculate the number of words in the text
        $wordCount = str_word_count($text,0,"АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя");




        // Calculate the average reading speed in words per minute
        $wordsPerMinute = 120; // You can adjust this value based on your desired reading speed

        // Calculate the reading time in minutes
        $readingTime = $wordCount / $wordsPerMinute;

        // Round the reading time to the nearest integer
        $readingTime = round($readingTime);


        return $readingTime;
    }
}
