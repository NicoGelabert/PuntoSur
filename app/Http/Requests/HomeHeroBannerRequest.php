<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeHeroBannerRequest extends FormRequest
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
            'image' => ['nullable', 'image'],
            'headline' => ['nullable', 'max:200'],
            'description' => ['nullable', 'string'],
            'link' => ['nullable', 'max:200'],
            'other_info' => ['nullable', 'max:200'],
            'published' => ['required', 'boolean']
        ];
    }
}
