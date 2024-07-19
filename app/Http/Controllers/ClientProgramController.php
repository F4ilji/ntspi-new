<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignDegreeResource;
use App\Http\Resources\ClientNavigationResource;
use App\Http\Resources\DirectionStudyResource;
use App\Http\Resources\EducationalProgramFullResource;
use App\Http\Resources\MainSectionResource;
use App\Models\CampaignDegree;
use App\Models\DirectionStudy;
use App\Models\EducationalProgram;
use App\Models\MainSection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientProgramController extends Controller
{
    public function index(Request $request, $slug)
    {
        $degrees = CampaignDegree::all();
        $degree = new CampaignDegreeResource(CampaignDegree::query()->where('slug', $slug)->latest()->first());
        $mainSections = MainSectionResource::collection(MainSection::all());
        $naprs = DirectionStudyResource::collection(DirectionStudy::query()->has('programs')->get());
        return Inertia::render('Client/Programs/Index', compact('mainSections', 'naprs', 'degree', 'degrees'));
    }

    public function show($id)
    {
        $navigation = ClientNavigationResource::collection(MainSection::with('subSections.pages')->orderBy('sort', 'asc')->get());
        $program = new EducationalProgramFullResource(EducationalProgram::find($id));
        $napr = DirectionStudy::first();
        return Inertia::render('Client/Programs/Show', compact('navigation', 'program'));
    }
}
