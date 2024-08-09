<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientFullInfoPersonResource extends JsonResource
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
            'name' => $this->name,
            'details' => new ClientPersonDetailResource($this->whenLoaded('userDetail')),
            'departments_work' => ClientPersonDepartmentsWorkResource::collection($this->whenLoaded('departments_work')),
            'departments_teach' => ClientPersonDepartmentsTeachResource::collection($this->whenLoaded('departments_teach')),
            'divisions_works' => ClientPersonDivisionsWorkResource::collection($this->whenLoaded('divisions')),
            'faculties_works' => ClientPersonFacultiesWorkResource::collection($this->whenLoaded('faculties'))
        ];
    }
}
