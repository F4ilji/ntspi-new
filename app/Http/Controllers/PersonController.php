<?php

namespace App\Http\Controllers;

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

    public function show(UserDetail $userDetail)
    {
        $navigation = ClientNavigationResource::collection(MainSection::with('subSections.pages')->orderBy('sort', 'asc')->get());
        return Inertia::render('Client/Persons/Show', compact('userDetail', 'mainSections'));
    }
}
