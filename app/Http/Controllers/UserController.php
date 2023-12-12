<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = UserResource::collection(User::all());
        return Inertia::render('AdminPanel/Users/Index', compact('users'));
    }

    public function show(int $id)
    {
        $user = new PostResource(User::find($id));
        return Inertia::render('AdminPanel/Users/Show', compact('user'));
    }

    public function create()
    {
        return Inertia::render('AdminPanel/Users/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        User::firstOrCreate($data);
        return redirect()->route('admin.user.index');
    }

    public function edit(User $user)
    {
        $user = new UserResource($user);
        return Inertia::render('AdminPanel/Users/Edit', compact('user'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        return redirect()->route('admin.user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
    }
}
