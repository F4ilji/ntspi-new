<?php

namespace App\Http\Controllers;

use App\Http\Requests\Schedule\StoreRequest;
use App\Http\Resources\FacultyResource;
use App\Http\Resources\MainSectionResource;
use App\Http\Resources\ScheduleResource;
use App\Models\Faculty;
use App\Models\MainSection;
use App\Models\Schedule;
use App\Models\SubSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = ScheduleResource::collection(Schedule::query()->ExistSubSchedule()->orderBy('name')->paginate(10));
        return Inertia::render('AdminPanel/Schedules/Index', compact('schedules'));
    }

    public function create()
    {
        $faculties = FacultyResource::collection(Faculty::all());
        return Inertia::render('AdminPanel/Schedules/Create', compact('faculties'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->storeSchedules($request->file('files'), $data);

        return redirect()->route('admin.index');
    }

    public function show(Schedule $schedule)
    {
        $schedule = new ScheduleResource($schedule);
        return Inertia::render('AdminPanel/Schedules/Show', compact('schedule'));
    }

    public function clientIndex(Request $request)
    {
        $mainSections = MainSectionResource::collection(MainSection::all());

        $schedules = collect();

        if (request()->filled('search')) {
            $schedules = ScheduleResource::collection(Schedule::query()
                ->where('name', 'like', '%' . request()->input('search') . '%')
                ->ExistSubSchedule()
                ->orderBy('name')
                ->get());
        }

        $searchRequest = request()->input('search');
        return Inertia::render('Schedule', compact('schedules', 'mainSections', 'searchRequest'));
    }



    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
    }
    private function storeSchedules($files, $data)
    {
        foreach ($files as $file) {
            $scheduleTitle = $this->generateScheduleTitle($file);
            $schedule = $this->storeSchedule($scheduleTitle, $data);
            $this->storeSubSchedule($file, $schedule);
        }
    }

    private function generateScheduleTitle($file)
    {
        $str = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $words = explode(' ', $str);
        return implode(' ', array_slice($words, 0, 2));
    }

    private function storeSchedule($title, $data)
    {
        return Schedule::firstOrCreate([
            'name' => $title,
            'faculty_id' => $data['faculty_id'],
            'is_fullTime' => $data['is_fullTime'],
        ]);
    }

    private function storeSubSchedule($file, $schedule)
    {
        $path = Storage::disk('public')->putFileAs('/schedules', $file, $file->getClientOriginalName());
        SubSchedule::updateOrCreate([
            'name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'path_file' => '/storage/'.$path,
            'schedule_id' => $schedule->id,
        ]);
    }

}
