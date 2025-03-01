<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ClientListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'full_name' => $this->full_name,
            'age' => $this->age,
            'town' => $this->town,
            'updated_at' => (new \DateTime($this->updated_at))->format('d-m-Y'),
        ];
    }
}
