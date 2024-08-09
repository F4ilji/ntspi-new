<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdditionalEducationCategoryResource;
use App\Http\Resources\AdditionalEducationResource;
use App\Http\Resources\DirectionAdditionalEducationResource;
use App\Models\AdditionalEducation;
use App\Models\AdditionalEducationCategory;
use App\Models\DirectionAdditionalEducation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientAdditionalEducationController extends Controller
{
    public function index(Request $request)
    {
        $directionAdditionalEducations = DirectionAdditionalEducationResource::collection(
            DirectionAdditionalEducation::query()
                ->where('is_active', true)
                ->whereHas('additionalEducationCategories', function ($q) {
                    $q->whereHas('additionalEducations');
            })
                ->get());
        $additionalEducations = AdditionalEducationCategoryResource::collection(AdditionalEducationCategory::query()
            ->where('is_active', '=', true)
            ->when($request->input('dir_id'), function ($q, $direction_id) {
                $q->where('dir_addit_educat_id', $direction_id);
            })
            ->has('additionalEducations')
            ->with('additionalEducations')
            ->get());
        $filters = [
            'dir_id' => request()->input('dir_id')
        ];
        return Inertia::render('Client/Additional-educations/Index', compact('directionAdditionalEducations', 'additionalEducations', 'filters'));
    }

    public function show(string $id)
    {
        $additionalEducation = new AdditionalEducationResource(AdditionalEducation::query()->with('category.direction')->find($id));
        return Inertia::render('Client/Additional-educations/Show', compact('additionalEducation'));
    }
}
