<?php

namespace App\Http\Requests;

use App\Models\Alergen;
use Illuminate\Foundation\Http\FormRequest;

class StoreAlergenRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:alergens,id'],
            'image' => ['required', 'image'],
            'active' => ['required', 'boolean']
        ];
    }
}
