<?php

namespace App\Http\Requests\Page;

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
            'title' => 'required|max:255|min:5',
            'content' => 'required|array',
            'content.blocks' => 'required|array|min:1',
            'code' => 'required|integer',
            'slug' => 'required|unique:pages,slug',
            'path' => 'required|unique:pages,path',
            'search_data' => 'required|string'
        ];
    }
}
