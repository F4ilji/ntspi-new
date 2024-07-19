<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContestResource extends JsonResource
{
    const formOfStudy = [
        1 => "Очная",
        2 => "Очно-Заочная",
        3 => "Заочная",
    ];

    const sourceOfFinancing = [
        1 => "Бюджетных мест",
        2 => "Целевая квота",
        3 => "Особая квота",
        4 => "Платных мест",
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
            'form_of_study' => self::formOfStudy[$this->form_obuch],
            'source' => self::sourceOfFinancing[$this->source],
            'count_places' => $this->count_places,
            'start_date_of_dispatch_doc' => $this->start_date_of_dispatch_zajavl,
            'end_date_of_dispatch_doc' => $this->end_date_of_dispatch_zajavl,
            'start_date_of_dispatch_consent' => $this->start_date_of_dispatch_consent,
            'end_date_of_dispatch_consent' => $this->end_date_of_dispatch_consent,
        ];
    }
}
