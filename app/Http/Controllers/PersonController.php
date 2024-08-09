<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientFullInfoPersonResource;
use App\Http\Resources\ClientNavigationResource;
use App\Http\Resources\MainSectionResource;
use App\Http\Resources\UserDetailResource;
use App\Http\Resources\UserResource;
use App\Models\MainSection;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonController extends Controller
{
    public function index()
    {
        $persons = UserDetailResource::collection(UserDetail::all());
        $filters = [
            'search' => request()->input('search'),
        ];
        return Inertia::render('Client/Persons/Index', compact('persons', 'filters'));
    }

    public function show(string $id)
    {
        $person = new ClientFullInfoPersonResource(User::query()->with(['userDetail', 'departments_work.faculty', 'departments_teach.faculty', 'divisions', 'faculties'])->where('id', $id)->firstOrFail());
        return Inertia::render('Client/Persons/Show', compact('person'));
    }
}
