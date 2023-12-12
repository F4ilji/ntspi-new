<?php

namespace App\Http\Controllers;

use App\Http\Resources\MainSectionResource;
use App\Models\MainSection;
use App\Models\SubSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MainSectionController extends Controller
{
    public function index()
    {
        $mainSections = MainSectionResource::collection(MainSection::paginate(10));
        return Inertia::render('AdminPanel/MainSection/Index', compact('mainSections'));
    }

    public function create()
    {
        $subSections = SubSection::query()->where('main_section_id', '=', null)->get();
        return Inertia::render('AdminPanel/MainSection/Create', compact('subSections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:main_sections|max:50|min:5',
            'subSection_ids' => 'array',
            'subSection_ids.*' => 'exists:sub_sections,id'
        ]);
        $subSection_ids = $data['subSection_ids'];
        unset($data['subSection_ids']);
        $mainSection = MainSection::create($data);
        SubSection::whereIn('id', $subSection_ids)->update(['main_section_id' => $mainSection->id]);
        return Inertia::render('AdminPanel/MainSection/Index');

    }

    public function edit(MainSection $mainSection)
    {
        $subSections = SubSection::query()->where('main_section_id', '=', $mainSection->id)->
            orWhere('main_section_id', '=', null)
            ->get();
        $subSection_ids = SubSection::query()->where('main_section_id', '=', $mainSection->id)->pluck('id');
        $mainSection = new MainSectionResource($mainSection);
        return Inertia::render('AdminPanel/MainSection/Edit', compact('mainSection', 'subSections', 'subSection_ids'));
    }

    public function update(MainSection $mainSection, Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories|max:50|min:5',
            'subSection_ids' => 'array',
            'subSection_ids.*' => 'exists:sub_sections,id'
        ]);
        $subSection_ids = $data['subSection_ids'];
        unset($data['subSection_ids']);
        $mainSection->update($data);
        SubSection::query()->where('main_section_id', '=', $mainSection->id)->update(['main_section_id' => NULL]);
        SubSection::whereIn('id', $subSection_ids)->update(['main_section_id' => $mainSection->id]);
        return redirect()->route('admin.mainSection.index');
    }

    public function destroy(MainSection $mainSection)
    {
        SubSection::query()->where('main_section_id', '=', $mainSection->id)->update(['main_section_id' => NULL]);
        $mainSection->delete();
    }
}
