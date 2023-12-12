<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
            'slug' => $this->slug,
            'code' => $this->code,
            'path' => $this->path,
            'section' => $this->section ? $this->section->title : null,
            'created_at' => $this->created_at->diffforhumans()
        ];
    }
}
