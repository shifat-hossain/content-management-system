<?php

namespace App\Http\Requests\User\Post;

use App\Http\Requests\Concerns\PostRequest;

class UpdatePostRequest extends PostRequest
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
            'title' => 'unique:posts,title,' . $this->post->id,
            'slug' => 'unique:posts,slug,' . $this->post->id,
        ]);
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => str($this->title)->slug()
        ]);
    }
}
