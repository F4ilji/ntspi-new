<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientPersonFacultiesWorkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_faculty' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'position' => $this->pivot->position,
        ];
    }
}
