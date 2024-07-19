<?php

namespace App\Http\Controllers;

use App\Http\Requests\Division\StoreRequest;
use App\Http\Requests\Division\UpdateRequest;
use App\Http\Resources\DivisionResource;
use App\Http\Resources\UserResource;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DivisionController extends Controller
{
    public function index(Request $request)
    {
        $divisions = DivisionResource::collection(Division::query()
            ->when(request()->input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(request()->input('perPage', 9))
            ->withQueryString());
        $filters = [
            'search' => request()->input('search'),
        ];
        return Inertia::render('AdminPanel/Divisions/Index', compact('divisions', 'filters'));
    }

    public function create()
    {
        return Inertia::render('AdminPanel/Divisions/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['description'] = json_encode($data['description']);
        Division::create($data);
        return redirect()->route('admin.division.index');
    }

    public function edit(Division $division)
    {
        $division = new DivisionResource($division);
        $users = UserResource::collection(User::all());
        return Inertia::render('AdminPanel/Divisions/Edit', compact('division', 'users'));
    }

    public function update(Division $division, UpdateRequest $request)
    {
        $data = $request->validated();
        $data['description'] = json_encode($data['description']);
        $division->update($data);
        return redirect()->route('admin.division.index');
    }

    public function destroy(string $id)
    {
        $category = Division::find($id);
        $category->delete();

        return redirect()->route('admin.division.index');
    }
}
