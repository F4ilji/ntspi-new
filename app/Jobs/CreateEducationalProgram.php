<?php

namespace App\Jobs;

use App\Models\DirectionStudy;
use App\Models\EducationalProgram;
use App\Services\Vicon\EducationalProgram\EducationalProgramService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateEducationalProgram implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $educatinalProgramService;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->educatinalProgramService = new EducationalProgramService();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $programs = [];
        $programsUuid = $this->educatinalProgramService->getAllProgramsUuid();

        foreach ($programsUuid as $uuid) {
            $program = $this->educatinalProgramService->getProgram($uuid);
            if ($program !== null) {
                array_push($programs, $program);
            } else {
                Log::error("Не удалось получить данные о программе с UUID: $uuid");
            }
        }

        foreach ($programs as $program) {
            $direction = DirectionStudy::where('uuid', $program->napr_uuid)->first();
            if ($direction !== null) {
                EducationalProgram::updateOrCreate(
                    ['uuid' => $program->uuid],
                    [
                        'name' => $program->name_op,
                        'inner_code' => $program->inner_code,
                        'lvl_edu' => $program->lvl_edu,
                        'status' => $program->status,
                        'lang_stud' => $program->lang_stud,
                        'learning_forms' => $program->learning_forms,
                        'direction_study_id' => $direction->id,
                    ]
                );
            } else {
                Log::error("Не удалось найти направление обучения с UUID: {$program->napr_uuid}");
            }
        }
    }
}