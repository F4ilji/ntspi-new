<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientDepartmentController extends Controller
{
    public function show(string $facultySlug, string $departmentSlug)
    {
        $faculty = Faculty::query()->where('slug', $facultySlug)->first();
        $departments = DepartmentResource::collection(
            Department::with('faculty', 'workers.userDetail', 'teachers.userDetail')
                ->where('is_active', true)
                ->where('faculty_id', $faculty->id)
                ->get()
        );
        $department = new DepartmentResource(Department::query()->where('slug', $departmentSlug)->where('is_active', true)->with('faculty')->first());
        return Inertia::render('Client/Departments/Show', compact('department', 'departments'));
    }
}
