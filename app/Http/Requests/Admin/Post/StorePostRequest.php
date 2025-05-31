<?php

namespace App\Http\Requests\Admin\Post;

use App\Http\Requests\Admin\Post\Concerns\PostRequest;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends PostRequest
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
            'user_id' => 'required|exists:users,id',
        ]);
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => str($this->title)->slug(),
            'user_id' => auth()->user()->id,
            'approved_status' => 'approved',
        ]);
    }
}
