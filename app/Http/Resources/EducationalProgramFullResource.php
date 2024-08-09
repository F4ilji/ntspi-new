<?php

namespace App\Http\Resources;

use App\Enums\FormEducation;
use App\Enums\LevelEducational;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationalProgramFullResource extends JsonResource
{
    /**
     * Преобразовать ресурс в массив.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'about_program' => $this->about_program,
            'program_features' => $this->program_features,
            'inner_code' => $this->inner_code,
            'lvl_edu' => $this->lvl_edu->getLabel(),
            'status' => $this->status,
            'lang_stud' => $this->lang_stud,
            'learning_forms' => $this->transformLearningForms($this->learning_forms),
            'directionStudy' => $this->directionStudy,
            'admissionPlans' => $this->admission_plans,
        ];
    }

    private function transformLearningForms(array $learningForms): array
    {
        return array_map(function ($form) {
            $formId = $form['form_id'];
            $formEnum = FormEducation::from($formId); // Получаем enum по form_id

            return [
                'form_edu' => $formEnum->getLabel(), // Значение из enum
                'period_data' => $form['period_data'],
            ];
        }, $learningForms);
    }
}
