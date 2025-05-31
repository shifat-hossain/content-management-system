<?php

namespace App\Http\Requests\Admin\Category;

use App\Http\Requests\Admin\Category\Concerns\CategoryRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends CategoryRequest
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
        return array_merge(parent::rules(), [
            'name' => Rule::unique('categories')->ignore($this->category),
            'slug' => Rule::unique('categories')->ignore($this->category)
        ]);
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => str($this->name)->slug(),
        ]);
    }
}
