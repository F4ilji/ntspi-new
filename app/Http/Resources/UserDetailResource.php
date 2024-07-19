<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
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
            'name' => $this->name ? $this->name : null,
            'surname' => $this->surname,
            'middleName' => $this->middleName,
            'photo' => $this->photo,
            'academicTitle' => $this->academicTitle,
            'educatorPosition' => $this->educatorPosition,
            'education' => $this->education,
            'awards' => $this->awards,
            'professDisciplines' => $this->professDisciplines,
            'professionalRetraining' => $this->professionalRetraining,
            'professionalDevelopment' => $this->professionalDevelopment,
            'workExperience' => $this->workExperience,
            'attendedConferences' => $this->attendedConferences,
            'participationScienceProjects' => $this->participationScienceProjects,
            'publications' => $this->publications,
            'trainingAids' => $this->trainingAids,
            'contactEmail' => $this->contactEmail,
            'contactPhone' => $this->contactPhone,
        ];
    }
}
