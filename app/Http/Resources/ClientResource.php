<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'slug' => $this->slug,
            'age' => $this->age,
            'phone_number' => $this->phone_number,
            'emergency_phone_number' => $this->emergency_phone_number,
            'town' => $this->town,
            'occupancy' => $this->occupancy,
            'email' => $this->email,
            'producto' => $this->producto,
            'sore' => $this->sore,
            'medication' => $this->medication,
            'allergies' => $this->allergies,
            'medicalBackground' => $this->medicalBackground,
            'sports' => $this->sports,
            'currentDiet' => $this->currentDiet,
            'sleepPatterns' => $this->sleepPatterns,
            'waterIntake' => $this->waterIntake,
            'pregnancy' => $this->pregnancy,
            'menopause' => $this->menopause,
            'signed' => (bool)$this->signed,
            'created_at' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
        ];
    }
}
