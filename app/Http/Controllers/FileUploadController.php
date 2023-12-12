<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            if ($file->isValid()) {
                // Генерируем уникальное имя файла
                $filename = md5(Carbon::now() . '_' . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();

                // Сохраняем файл в папку public/files
                $path = Storage::disk('public')->putFileAs('/files', $file, $filename);

                // Генерируем полный URL к загруженному файлу с использованием функции asset
                $fileUrl = '/storage/' . $path;

                // Возвращаем JSON-ответ с заданным форматом
                return response()->json([
                    'success' => 1,
                    'file' => [
                        'url' => $fileUrl,
                    ],
                ]);
            }
        }
        return response()->json(['error' => 'File upload failed'], 400);
    }
}
