<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ClientEventResource extends JsonResource
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
            'slug' => $this->slug,
            'event_date_start' => $this->event_date_start,
            'event_time_start' => Carbon::parse($this->event_time_start)->format('H:i'),
            'address' => $this->address,
            'is_online' => $this->is_online,
            'category' => $this->category->title,
        ];
    }
}
