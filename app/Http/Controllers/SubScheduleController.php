<?php

namespace App\Http\Controllers;

use App\Models\SubSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubScheduleController extends Controller
{
    public function destroy(SubSchedule $subSchedule)
    {
        Storage::delete($subSchedule->path_file);
        $subSchedule->delete();
    }
}
