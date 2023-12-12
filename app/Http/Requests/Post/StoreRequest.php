<?php

namespace App\Http\Requests\Post;

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
            'is_published' => 'required|boolean',
            'category_id' => 'nullable|exists:categories,id',
            'author' => 'nullable|string|min:5',
            'images' => 'nullable|array'
        ];
    }
}
