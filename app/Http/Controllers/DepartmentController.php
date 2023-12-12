<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\StoreRequest;
use App\Http\Requests\Department\UpdateRequest;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\FacultyResource;
use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = DepartmentResource::collection(Department::all());
        return Inertia::render('AdminPanel/Departments/Index', compact('departments'));
    }

    public function create()
    {
        $faculties = FacultyResource::collection(Faculty::all());
        return Inertia::render('AdminPanel/Departments/Create', compact('faculties'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Department::firstOrCreate($data);
        return redirect()->route('admin.department.index');
    }

    public function edit(Department $department)
    {
        return Inertia::render('AdminPanel/Departments/Edit', compact('department'));
    }

    public function update(UpdateRequest $request, Department $department)
    {
        $data = $request->validated();
        $department->update($data);
        return redirect()->route('admin.department.index');
    }

    public function destroy(Department $department)
    {
        $department->delete();
    }
}
