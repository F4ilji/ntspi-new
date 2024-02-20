<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\Student\StoreRequest;
use App\Http\Requests\Student\UpdateRequest;
use App\Http\Resources\StudentResource;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageTool;


class StudentController extends Controller
{
    public function index()
    {
        $students = StudentResource::collection(Student::paginate(10));
        return Inertia::render('AdminPanel/Student/Index', compact('students'));
    }

    public function show(Student $student)
    {
        $student = new StudentResource($student);
        return Inertia::render('Client/Student/Show', compact('student'));
    }

    public function create()
    {
        return Inertia::render('AdminPanel/Student/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        if ($request->file('photo')) {
            $data['photo'] = $this->storePhoto($request->file('photo'));
        }
        Student::create($data);
        return redirect()->route('admin.student.index');
    }

    public function edit(Student $student)
    {
        return Inertia::render('AdminPanel/Student/Edit', compact('student'));
    }

    public function update(Student $student, UpdateRequest $request)
    {
        $data = $request->validated();
        if ($request->file('photo')) {
            $data['photo'] = $this->storePhoto($request->file('photo'));
        }
        $student->update($data);
        return redirect()->route('admin.student.index');
    }

    public function destroy(Student $student)
    {
    $student->delete();
    }

    private function storePhoto(UploadedFile $file)
    {
        if ($file->isValid()) {
            $image = $file;
            // Генерируем уникальное имя файла, чтобы избежать конфликтов
            $filename = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            // Сохраняем изображение в директорию public
            ImageTool::configure(['driver' => 'imagick']);

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
