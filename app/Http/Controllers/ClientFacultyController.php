<?php

namespace App\Http\Controllers;

use App\Http\Resources\FacultyResource;
use App\Http\Resources\FullFacultyResource;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientFacultyController extends Controller
{
    public function index()
    {
        $faculties = FacultyResource::collection(Faculty::query()->where('is_active', true)->get());
        return Inertia::render('Client/Faculties/Index', compact('faculties'));
    }

    public function show(string $slug)
    {
        $faculties = FacultyResource::collection(Faculty::query()->where('is_active', true)->get());
        $faculty = new FullFacultyResource(Faculty::where('slug', $slug)->where('is_active', true)->with(['departments.faculty', 'workers.userDetail'])->first());
        return Inertia::render('Client/Faculties/Show', compact('faculty', 'faculties'));
    }
}
