<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'tags' => 'array|nullable',
            'tags.*' => 'string',
            'data.*.language_id' => ['required', 'integer', 'between:1,3', 'distinct'],
            'data.*.title' => 'required|string|max:255',
            'data.*.description' => 'required|string',
            'data.*.content' => 'required|string'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */

    public function messages(): array
    {
        return [
            'tags.array' => 'Tags must be an array.',
            'tags.*.string' => 'Each tag must be a string.',
            'data.*.language_id.required' => 'A language ID is required.',
            'data.*.language_id.integer' => 'The language ID must be an integer.',
            'data.*.language_id.between' => 'The language ID must be between 1 and 3.',
            'data.*.language_id.distinct' => 'Each language ID must be unique.',
            'data.*.title.required' => 'A title is required.',
            'data.*.title.string' => 'The title must be a string.',
            'data.*.title.max' => 'The title must not exceed 255 characters.',
            'data.*.description.required' => 'A description is required.',
            'data.*.description.string' => 'The description must be a string.',
            'data.*.content.required' => 'Content is required.',
            'data.*.content.string' => 'The content must be a string.',
        ];
    }


}
