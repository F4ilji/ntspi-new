<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationalProgramFullResource extends JsonResource
{

    const studyPeriod = [
        "44.03.01" => "4 года 6 месяцев",
        "44.03.05" => "5 лет",
        "44.03.02" => "4 года 6 месяцев",
        "39.03.02" => "4 года 6 месяцев",
        "44.03.03" => "4 года 6 месяцев",
        "49.02.01" => "3 года 10 месяцев",
        "20.02.02" => "3 года 10 месяцев",
        "54.01.20" => "3 года 10 месяцев",
        "44.04.01" => "2 года 6 месяцев",
    ];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'napr' => $this->directionStudy,
            'degree' => $this->directionStudy->degree->name,
            'studyPeriod' => self::studyPeriod[$this->directionStudy->code],
            'exams' => ExamResource::collection($this->exams),
            'contests' => ContestResource::collection($this->contests),
        ];
    }
}
