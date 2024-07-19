<?php

namespace App\Http\Controllers;

use App\Jobs\CreateDirectionStudy;
use App\Jobs\CreateEducationalProgram;
use App\Services\Vicon\EducationalProgram\EducationalProgramService;

class UpdateEduDataApiController extends Controller
{
    private $programService;

    public function __construct()
    {
        $this->programService = new EducationalProgramService();
    }

    public function index()
    {
        $this->updateOrCreateDirectionStudy();
        $this->updateOrCreateEducationProgram();
        return redirect()->route('index');
    }

    private function updateOrCreateDirectionStudy() : void
    {
        dispatch(new CreateDirectionStudy());
    }
    private function updateOrCreateEducationProgram() : void
    {
        dispatch(new CreateEducationalProgram());
    }
}
