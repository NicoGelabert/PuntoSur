<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ProductResource extends JsonResource
{
    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'link' => $this->link,
            'published' => (bool)$this->published,
            'categories' => $this->categories->map(fn($c) => $c->id),
            'alergens' => $this->alergens->map(fn($a) => $a->id),
            'prices' => $this->prices->map(function ($price) {
                return [
                    'id' => $price->id,
                    'number' => $price->number,
                    'size' => $price->size,
                ];
            }),
            'tags' => $this->tags->map(fn($t) => $t->id),
            'image_url' => $this->image,
            'images' => $this->images,
            'created_at' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
        ];
    }
}
