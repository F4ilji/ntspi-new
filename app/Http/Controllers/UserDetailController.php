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
            // Генерируем уникальное имя файла
            $filename = md5(Carbon::now() . '_' . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();

            // Сохраняем файл в папку public/files
            $path = Storage::disk('public')->putFileAs('/photos', $file, $filename);

            // Генерируем полный URL к загруженному файлу с использованием функции asset
            $fileUrl = '/storage/' . $path;

            // Возвращаем JSON-ответ с заданным форматом
            return $fileUrl;
        }
    }
}
