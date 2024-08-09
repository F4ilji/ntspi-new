<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientEducationalGroupResource;
use App\Http\Resources\ScheduleResource;
use App\Models\EducationalGroup;
use App\Models\Faculty;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientScheduleController extends Controller
{
    public function index(Request $request)
    {
        $educationalGroups = collect();

        if (request()->filled('search')) {
            $educationalGroups = ClientEducationalGroupResource::collection(EducationalGroup::query()
                ->has('schedules')
                ->whereHas('schedules', function ($q) {
                    $q->when(request()->input('search'), function ($query, $search) {
                        $query->whereRaw('LOWER(title) like ?', ["%".strtolower($search)."%"]);
                    });
                })
                ->with('schedules')
                ->orderBy('title')
                ->get());
        }

        $searchRequest = request()->input('search');

        return Inertia::render('Client/Schedules/Index', compact('educationalGroups', 'searchRequest'));
    }

    public function show($id)
    {
        $schedule = Schedule::find($id);
        return Inertia::render('Client/Schedules/Show', compact('schedule'));
    }
}
