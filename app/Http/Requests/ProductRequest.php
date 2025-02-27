<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:2000'],
            'description' => ['nullable', 'string'],
            'link' => ['nullable', 'string'],
            'published' => ['required', 'boolean'],
            'categories.*' => ['nullable', 'int', 'exists:categories,id'],
            'prices' => ['required', 'array'],
            'prices.*.number' => ['required', 'numeric', 'min:0.01'],
            'prices.*.size' => ['required', 'string', 'max:200'],
            'images.*' => ['nullable', 'image'],
            'deleted_images.*' => ['nullable', 'int'],
            'image_positions.*' => ['nullable', 'int'],
            'benefits' => ['nullable', 'array'],
            'benefits.*.text' => ['nullable', 'string'],
        ];
    }
}
