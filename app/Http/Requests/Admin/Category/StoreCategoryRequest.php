<?php

namespace App\Http\Requests\Admin\Category;

use App\Http\Requests\Admin\Category\Concerns\CategoryRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends CategoryRequest
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
            'status' => 'required|boolean',
        ]);
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => 1,
            'slug' => str($this->name)->slug(),
        ]);
    }
}
