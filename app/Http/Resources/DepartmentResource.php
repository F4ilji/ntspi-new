<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'faculty' => $this->faculty,
            'slug' => $this->slug,
            'workers' => ClientPersonDepartmentPreviewResource::collection($this->workers),
            'teachers' => ClientPersonDepartmentTeachPreviewResource::collection($this->teachers)
        ];
    }
}
