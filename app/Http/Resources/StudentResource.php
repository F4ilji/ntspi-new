<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'surname' => $this->surname,
            'middleName' => $this->middleName,
            'photo' => $this->photo,
            'position' => $this->position,
            'education' => $this->education,
            'vk_link' => $this->vk_link,
            'contactEmail' => $this->contactEmail,
            'contactPhone' => $this->contactPhone,
            'created_at' => $this->created_at,
        ];
    }
}
