<?php

namespace App\Http\Resources;

use App\Http\Resources\Frontend\TravelResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Tour
 */
class TourResource extends JsonResource
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
            'name' => $this->name,
            'startingDate' => $this->startingDate->toDateTimeString(),
            'endingDate' => $this->endingDate->toDateTimeString(),
            'price' => number_format($this->price, 2),
        ];
    }
}
