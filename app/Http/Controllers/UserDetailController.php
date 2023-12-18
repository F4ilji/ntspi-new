<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDetail\StoreRequest;
use App\Http\Requests\UserDetail\UpdateRequest;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\ImageManagerStatic as ImageTool;

class UserDetailController extends Controller
{
    public function create(User $user)
    {
        $userId = $user->id;
        return Inertia::render('AdminPanel/UserDetail/Create', compact('userId'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        if ($request->file('photo')) {
            $data['photo'] = $this->storePhoto($request->file('photo'));
        }
        UserDetail::create($data);
        return redirect()->route('admin.user.index');
    }

    public function edit(UserDetail $userDetail)
    {
        return Inertia::render('AdminPanel/UserDetail/Edit', compact('userDetail'));
    }

    public function update(UserDetail $userDetail, UpdateRequest $request)
    {
        $data = $request->validated();
        if ($request->file('photo')) {
            $data['photo'] = $this->storePhoto($request->file('photo'));
        }
        $userDetail->update($data);
        return redirect()->route('admin.user.index');
    }

    private function storePhoto(UploadedFile $file)
    {
        if ($file->isValid()) {
            $image = $file;
            // Генерируем уникальное имя файла, чтобы избежать конфликтов
            $filename = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            // Сохраняем изображение в директорию public
            ImageTool::make($image)
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(storage_path('app/public/photos/' . $filename));
            $path = "/storage/photos/" . $filename;
            // Генерируем URL для доступа к изображению
            return $path;
        }

    }
}
