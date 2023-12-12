<?php

namespace App\Http\Controllers;

use App\Http\Resources\MainSectionResource;
use App\Models\MainSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class MainController extends Controller
{
    public function index()
    {
        $mainSections = MainSectionResource::collection(MainSection::all());
        return Inertia::render('Main', compact('mainSections'));
    }
}
