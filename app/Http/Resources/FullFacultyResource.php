<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FullFacultyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'shortTitle' => $this->abbreviation,
            'slug' => $this->slug,
            'departments' => DepartmentResource::collection($this->departments),
            'workers' => ClientPersonFacultyPreviewResource::collection($this->workers),
        ];
    }
}
