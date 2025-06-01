<?php

namespace App\Http\Requests\Post\Concerns;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:posts,title',
            'slug' => 'nullable|unique:posts,slug',
            'description' => 'required|string',
            'category_ids.*' => 'required|exists:categories,id',
            'is_published' => 'nullable|boolean',
            'approved_status' => 'nullable|boolean',
            'approved_at' => 'nullable|boolean',
        ];
    }
}
