<?php

namespace App\Http\Controllers;

use App\Http\Resources\DivisionResource;
use App\Models\Division;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientDivisionController extends Controller
{
    public function index()
    {
        $divisions = DivisionResource::collection(Division::query()->where('is_active', true)->get());
        return Inertia::render('Client/Divisions/Index', compact('divisions'));
    }

    public function show(string $slug)
    {
        $divisions = DivisionResource::collection(Division::query()->where('is_active', true)->get());
        $division = new DivisionResource(Division::with('workers.userDetail')->where('is_active', true)->where('slug', $slug)->first());
        return Inertia::render('Client/Divisions/Show', compact('divisions', 'division'));
    }
}
