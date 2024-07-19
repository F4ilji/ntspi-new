<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'content' => json_decode($this->content),
            'is_online' => $this->is_online,
            'address' => $this->address,
            'event_date_start' => $this->event_date_start,
            'created_at' => $this->created_at->diffforhumans(),
        ];
    }
}
