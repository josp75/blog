<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class BlogFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|min:4',
            'slug' => ['required', 'regex:/^[a-z0-9\-]+$/']
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge(
            [
                'slug' => $this->input('slug') ? : Str::slug($this->input('title'))
            ]
        );
    }
}
