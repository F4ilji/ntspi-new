<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubSectionResource;
use App\Models\Page;
use App\Models\SubSection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubSectionController extends Controller
{
    public function index()
    {
        $subSections = SubSectionResource::collection(SubSection::paginate(10));
        return Inertia::render('AdminPanel/SubSection/Index', compact('subSections'));
    }

    public function create()
    {
        $pages = Page::query()->where('sub_section_id', '=', null)
            ->where('is_visible', '=', 1)->get();
        return Inertia::render('AdminPanel/SubSection/Create', compact('pages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:main_sections|max:50|min:5',
            'page_ids' => 'array',
            'page_ids.*' => 'exists:pages,id'
        ]);
        $page_ids = $data['page_ids'];
        unset($data['page_ids']);
        $subSection = SubSection::create($data);
        Page::whereIn('id', $page_ids)->update(['sub_section_id' => $subSection->id]);
        return Inertia::render('AdminPanel/SubSection/Index');

    }

    public function edit(SubSection $subSection)
    {
        $pages = Page::query()->where('sub_section_id', $subSection->id)
            ->orWhere(function ($query) {
                $query->where('sub_section_id', null);
                $query->where('is_visible', 1);
            })->get();
        $page_ids = Page::query()->where('sub_section_id', '=', $subSection->id)->pluck('id');
        $subSection = new SubSectionResource($subSection);
        return Inertia::render('AdminPanel/SubSection/Edit', compact('subSection', 'pages', 'page_ids'));
    }

    public function update(SubSection $subSection, Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories|max:50|min:5',
            'page_ids' => 'array',
            'page_ids.*' => 'exists:pages,id'
        ]);
        $page_ids = $data['page_ids'];
        unset($data['page_ids']);
        $subSection->update($data);
        Page::query()->where('sub_section_id', '=', $subSection->id)->update(['sub_section_id' => NULL]);
        Page::whereIn('id', $page_ids)->update(['sub_section_id' => $subSection->id]);
        return redirect()->route('admin.subSection.index');
    }

    public function destroy(SubSection $subSection)
    {
        Page::query()->where('sub_section_id', '=', $subSection->id)->update(['sub_section_id' => NULL]);
        $subSection->delete();
    }
}
