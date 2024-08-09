<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientPersonDepartmentsTeachResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_department' => $this->id,
            'title' => $this->title,
            'faculty_title' => $this->faculty->title,
            'slug' => $this->slug,
            'faculty_slug' => $this->faculty->slug,
            'position' => $this->pivot->teaching_position,
        ];
    }
}
