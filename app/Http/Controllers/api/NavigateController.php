<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientNavigationResource;
use App\Http\Resources\MainSectionResource;
use App\Models\MainSection;
use Illuminate\Http\Request;

class NavigateController extends Controller
{
    public function index()
    {
        return ClientNavigationResource::collection(MainSection::with('subSections.pages')->orderBy('sort', 'asc')->get());

    }
}
