<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EngineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'fuel_type' => $this->fuel_type,
        ];

        if($this->relationLoaded('tunes'))  {
            $data['tunes'] = TuneResource::collection($this->tunes->sortBy('sort'));
        }

        return $data;
    }
}
