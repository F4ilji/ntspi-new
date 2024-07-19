<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    const typeOfExam = [
        1 => "ЕГЭ",
        2 => "Вступительное испытание"
    ];

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => self::typeOfExam[$this->type],
            'is_creative_direction' => $this->is_creative_direction,
            'is_profile_direction' => $this->is_profile_direction,
            'priority' => $this->priority,
            'min_ball' => $this->min_ball,
            'max_ball' => $this->max_ball,
            'form_exam' => $this->form_exam,
            'language' => $this->language,
        ];
    }
}
