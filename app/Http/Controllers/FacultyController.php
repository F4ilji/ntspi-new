<?php

namespace App\Http\Controllers;

use App\Http\Requests\Faculty\StoreRequest;
use App\Http\Requests\Faculty\UpdateRequest;
use App\Http\Resources\FacultyResource;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = FacultyResource::collection(Faculty::all());
        $filters = [
            'search' => request()->input('search'),
        ];
        return Inertia::render('AdminPanel/Faculties/Index', compact('faculties', 'filters'));
    }

    public function create()
    {
        return Inertia::render('AdminPanel/Faculties/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Faculty::firstOrCreate($data);
        return redirect()->route('admin.faculty.index');
    }

    public function edit(Faculty $faculty)
    {
        return Inertia::render('AdminPanel/Faculties/Edit', compact('faculty'));
    }

    public function update(UpdateRequest $request, Faculty $faculty)
    {
        $data = $request->validated();
        $faculty->update($data);
        return redirect()->route('admin.faculty.index');
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
    }

}
