<?php

namespace App\Http\Resources;

use App\Enums\FormEducation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdditionalEducationResource extends JsonResource
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
            'content' => $this->content,
            'category' => $this->category->title,
            'directionAdditionalEducation' => new DirectionAdditionalEducationResource($this->category->direction),
            'target_group' => $this->target_group,
            'price' => $this->price,
            'qualification' => $this->qualification,
            'learning_time' => $this->learning_time,
            'form_education' => $this->form_education->getLabel(),
        ];
    }
}
