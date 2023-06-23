<?php

namespace App\Http\Requests\PostTranslation;

use Illuminate\Foundation\Http\FormRequest;

class PostTranslationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string'
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'A title is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title must not exceed 255 characters.',
            'description.required' => 'A description is required.',
            'description.string' => 'The description must be a string.',
            'content.required' => 'Content is required.',
            'content.string' => 'The content must be a string.',
        ];
    }
}
