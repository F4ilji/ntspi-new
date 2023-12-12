<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MainSectionResource;
use App\Models\MainSection;
use Illuminate\Http\Request;

class NavigateController extends Controller
{
    public function __invoke()
    {
        $mainSections = MainSectionResource::collection(MainSection::all());
        return $mainSections;
    }
}
