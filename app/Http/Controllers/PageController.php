<?php

namespace App\Http\Controllers;

use App\Http\Requests\Page\StoreRequest;
use App\Http\Requests\Page\UpdateRequest;
use App\Http\Resources\MainSectionResource;
use App\Http\Resources\PageResource;
use App\Http\Resources\RegisteredPageResource;
use App\Models\MainSection;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index() {
        $pages = PageResource::collection(Page::query()
            ->when(request()->input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->where('is_registered', false)
            ->orderBy('id', 'desc')
            ->paginate(request()->input('perPage', 9))
            ->withQueryString());
        $filters = request()->input('search');
        return Inertia::render('AdminPanel/Pages/Index', compact('pages', 'filters'));
    }
    public function getRegisteredPages()
    {
        $pages = PageResource::collection(Page::query()
            ->when(request()->input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->where('is_registered', true)
            ->where('is_visible', true)
            ->orderBy('id', 'desc')
            ->paginate(request()->input('perPage', 9))
            ->withQueryString());
        $filters = request()->input('search');
        return Inertia::render('AdminPanel/Pages/Registered', compact('pages', 'filters'));
    }


    public function create()
    {
        return Inertia::render('AdminPanel/Pages/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['content'] = json_encode($data['content']);
        Page::create($data);
        return redirect()->route('admin.page.index');
    }

    public function edit($slug)
    {
        $page = new PageResource(Page::where('slug', '=', $slug)->first());
        return Inertia::render('AdminPanel/Pages/Edit', compact('page'));
    }

    public function update(Page $page, UpdateRequest $request)
    {
        $data = $request->validated();
        $data['content'] = json_encode($data['content']);
        $page->update($data);
        return redirect()->route('admin.page.index');
    }

    public function editRegisteredPage($id)
    {
        $page = new RegisteredPageResource(Page::find($id));
        return Inertia::render('AdminPanel/Pages/EditRegisteredPage', compact('page'));
    }

    public function updateRegisteredPage($id, Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'path' => 'required',
            'is_visible' => 'required',
            'code' => 'required'
        ]);
        $page = Page::find($id);
        $page->update($data);
        return redirect()->route('admin.registered.page.index');
    }

    public function render($path)
    {
        $page = Page::where('path', '=', $path)->first();
        if ($page === null) {
            abort(404);
        }
        $mainSections = MainSectionResource::collection(MainSection::all());


        if (isset($page->section)) {
            $subSectionPages = PageResource::collection($page->section->pages);
            $breadcrumbs = [
                'mainSection' => $page->section->mainSection->title,
                'subSection' => $page->section->title,
                'page' => $page->title,
            ];
        } else {
            $subSectionPages = null;
            $breadcrumbs = null;
        }

        $page = new PageResource($page);

        if ($page->code != 200) {
            abort($page->code);
        }
        return Inertia::render('Page', compact('page', 'mainSections', 'subSectionPages', 'breadcrumbs'));
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.page.index');
    }
}
