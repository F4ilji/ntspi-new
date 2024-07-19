<?php

namespace App\Services\Vicon\DirectionStudy;

use Illuminate\Support\Facades\Http;

class DirectionStudyService
{
    const EDU_LEVELS = [1, 2, 3, 4, 5, 6];

    public function getAllNaprsUuid() : array
    {
        $naprs = [];
        $naprsUuid = [];
        foreach (self::EDU_LEVELS as $level) {
            $data = $this->getNaprs($level);
            $naprs = array_merge($naprs, $data->rows);
        }
        foreach ($naprs as $napr) {
            $naprUuid = $napr->uuid;
            array_push($naprsUuid, $naprUuid);
        }
        return $naprsUuid;
    }

    public function getAllProgramsUuid(): array
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

    public function getNaprs(int $edu_level): object
    {
        $data = $this->callAPI("https://db-nica.ru/api/v1/naprs?perPage=200&filter_edu_level=$edu_level", env('VICON_TOKEN'));
        return $data;
    }

    public function getNapr(string $uuid): object
    {
        $data = $this->callAPI("https://db-nica.ru/api/v1/napr/$uuid", env('VICON_TOKEN'));
        return $data;
    }

    public function getPrograms(int $edu_level): object
    {
        $data = $this->callAPI("https://db-nica.ru/api/v1/programs?filter_edu_level=$edu_level&perPage=200", env('VICON_TOKEN'));
        return $data;
    }

    public function getProgram(string $uuid): object
    {
        $data = $this->callAPI("https://db-nica.ru/api/v1/program/$uuid", env('VICON_TOKEN'));
        return $data;
    }

    public function getProgramDocs(string $uuid): object
    {
        $data = $this->callAPI("https://db-nica.ru/api/v1/program/$uuid/edu-docs?perPage=200", env('VICON_TOKEN'));
        return $data;
    }

    private function callAPI(string $endpoint, string $token = null): object
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