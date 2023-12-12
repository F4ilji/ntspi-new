<?php

namespace App\Http\Requests\UserDetail;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id|integer',
            'name' => 'required|string',
            'surname' => 'required|string',
            'middleName' => 'nullable|string',
            'academicTitle' => 'nullable|string',
            'administrativePosition' => 'nullable|string',
            'educatorPosition' => 'nullable|string',
            'education' => 'nullable|string',
            'awards' => 'nullable|string',
            'professDisciplines' => 'nullable|string',
            'professionalRetraining' => 'nullable|string',
            'professionalDevelopment' => 'nullable|string',
            'workExperience' => 'nullable|integer',
            'attendedConferences' => 'nullable|string',
            'participationScience_projects' => 'nullable|string',
            'publications' => 'nullable|string',
            'trainingAids' => 'nullable|string',
            'contactEmail' => 'nullable|email',
            'contactPhone' => 'nullable|string',
        ];
    }
}
