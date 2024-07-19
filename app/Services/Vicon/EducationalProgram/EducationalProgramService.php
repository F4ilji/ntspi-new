<?php

namespace App\Services\Vicon\EducationalProgram;

use App\Jobs\CreateDirectionStudy;
use App\Jobs\CreateEducationalProgram;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EducationalProgramService
{
    const EDU_LEVELS = [1,2,3,4,5,6];

    public function getAllProgramsUuid() : array
    {
        $programs = [];
        $programsUuid = [];
        foreach (self::EDU_LEVELS as $level) {
            $data = $this->getPrograms($level);
            $programs = array_merge($programs, $data->rows);
        }
        foreach ($programs as $program) {
            array_push($programsUuid, $program->uuid);
        }
        return $programsUuid;
    }

    public function getPrograms(int $edu_level) : object
    {
        $data = $this->callAPI("https://db-nica.ru/api/v1/programs?filter_edu_level=$edu_level&perPage=200", env('VICON_TOKEN'));
        return $data;
    }

    public function getProgram(string $uuid) : object
    {
        $data = $this->callAPI("https://db-nica.ru/api/v1/program/$uuid", env('VICON_TOKEN'));
        return $data;
    }

    private function callAPI(string $endpoint, string $token = null) : object|array
    {
        try {
            $response = Http::withToken($token)->get($endpoint);
            $data = $response->object();
            return $data;
        } catch (\Exception $e) {
            Log::error('Ошибка при вызове API: ' . $e->getMessage());
            throw $e;
        }
    }

}