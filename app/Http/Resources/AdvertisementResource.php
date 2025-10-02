<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'ad_id' => $this->id,
        'title' => $this->title,
        'city' => $this->city,
        'country' => $this->country,
        'description' => $this->description,
        'no_rooms' => $this->no_rooms,
        'property_size' => $this->property_size,
        'price' => $this->price,
        'property_type' => $this->property_type,
        ];
    }
}
