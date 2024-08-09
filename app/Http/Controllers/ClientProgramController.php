<?php

namespace App\Http\Controllers;

use App\Enums\LevelEducational;
use App\Http\Resources\CampaignDegreeResource;
use App\Http\Resources\ClientNavigationResource;
use App\Http\Resources\DirectionStudyResource;
use App\Http\Resources\EducationalProgramFullResource;
use App\Http\Resources\MainSectionResource;
use App\Models\AdmissionCampaign;
use App\Models\CampaignDegree;
use App\Models\DirectionStudy;
use App\Models\EducationalProgram;
use App\Models\MainSection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientProgramController extends Controller
{
//    public function index(Request $request, $slug)
//    {
//        $degrees = CampaignDegree::all();
//        $degree = new CampaignDegreeResource(CampaignDegree::query()->where('slug', $slug)->latest()->first());
//        $naprs = DirectionStudyResource::collection(DirectionStudy::query()->has('programs')->get());
//        return Inertia::render('Client/Programs/Index', compact('naprs', 'degree', 'degrees'));
//    }

    public function bakalavriat()
    {
        $naprs = DirectionStudyResource::collection(
            DirectionStudy::forBachelorLevel()
                ->withActiveAdmissionCampaign()
                ->withActivePrograms()
                ->get()
        );
        $campaignName = $this->getAdmissionCampaignName();
        return Inertia::render('Client/Programs/Index', compact('naprs', 'campaignName'));
    }

    public function spo()
    {
        $naprs = DirectionStudyResource::collection(
            DirectionStudy::forMiddleLevel()
                ->withActiveAdmissionCampaign()
                ->withActivePrograms()
                ->get()
        );
        $campaignName = $this->getAdmissionCampaignName();
        return Inertia::render('Client/Programs/Index', compact('naprs', 'campaignName'));

    }

    public function magistratura()
    {
        $naprs = DirectionStudyResource::collection(
            DirectionStudy::forMasterLevel()
                ->withActiveAdmissionCampaign()
                ->withActivePrograms()
                ->get()
        );
        $campaignName = $this->getAdmissionCampaignName();
        return Inertia::render('Client/Programs/Index', compact('naprs', 'campaignName'));

    }

    public function show($id)
    {
        $program = new EducationalProgramFullResource(EducationalProgram::query()->where('id', $id)->with(['admission_plans', 'directionStudy'])->first());
        return Inertia::render('Client/Programs/Show', compact('program'));
    }

    private function getAdmissionCampaignName() : string
    {
        $campaign = AdmissionCampaign::query()->where('status', 1)->first();
        return $campaign->name;
    }
}
