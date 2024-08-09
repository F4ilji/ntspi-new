<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientVirtualExhibitionListResource;
use App\Models\VirtualExhibition;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientVirtualExhibitionController extends Controller
{
    public function index()
    {
        $exhibitions = ClientVirtualExhibitionListResource::collection(VirtualExhibition::query()
            ->where('is_active', true)
            ->orderBy('id', 'desc')
            ->paginate(6));
        return Inertia::render('Client/Library-exhibitions/Index', compact('exhibitions'));
    }

    public function show(string $id)
    {
        $exhibition = new ClientVirtualExhibitionListResource(VirtualExhibition::query()->find($id));
        return Inertia::render('Client/Library-exhibitions/Show', compact('exhibition'));
    }
}
