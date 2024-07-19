<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'content' => $this->content,
            'is_published' => $this->is_published,
            'category' => $this->category,
            'authors' => $this->authors,
            'gallery' => new GalleryResource($this->gallery),
            'reading_time' => $this->reading_time,
            'created_post' => $this->created_at->diffforhumans(),
        ];
    }
}
