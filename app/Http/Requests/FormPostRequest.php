<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class FormPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['title' => "string", 'slug' => "string[]", 'content' => "string[]"])] public function rules(): array
    {
        return [
            'title' => 'required|min:8',
            'slug' => ['required',
                'min:8', 'regex:/^[0-9a-z\-]+$/',
                Rule::unique('posts')->ignore($this->route()->parameter('post'))
            ],
            'content' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['array', 'exists:tags,id', 'required'],
            'image' => ['image', 'max:2000']
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            [
                'slug' => $this->input('slug') ?: Str::slug($this->input('title'))
            ]
        );
    }
}
