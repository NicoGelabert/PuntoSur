<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'full_name' => ['required', 'max:200'],
            'age' => ['required', 'int'],
            'phone_number' => ['required', 'int'],
            'emergency_phone_number' => ['required', 'int'],
            'town' => ['required', 'max:100'],
            'occupancy' => ['required', 'max:100'],
            'email' => ['required'],
            'treatment' => ['required'],
            'sore' => ['required', 'max:1000'],
            'medication' => ['required', 'max:1000'],
            'allergies' => ['required', 'max:1000'],
            'medicalBackground' => ['required', 'max:1000'],
            'sports' => ['required', 'max:1000'],
            'currentDiet' => ['required'],
            'sleepPatterns' => ['required'],
            'waterIntake' => ['required'],
            'pregnancy' => ['required'],
            'menopause' => ['required'],
            'signed' => ['required', 'boolean'],
        ];
    }
}
