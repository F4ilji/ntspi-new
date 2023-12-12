<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageTool;


class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Генерируем уникальное имя файла, чтобы избежать конфликтов
            $filename = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            // Сохраняем изображение в директорию public
            ImageTool::make($image)
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(storage_path('app/public/images/' . $filename));
            $path = "/storage/images/" . $filename;
            // Генерируем URL для доступа к изображению
            return response()->json(['success' => 1, 'file' => ['url' => $path]]);
        }

        return response()->json(['error' => 'Image upload failed']);
    }


}
