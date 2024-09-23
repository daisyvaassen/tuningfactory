<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TuneResource extends JsonResource
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
            'original_hp' => $this->original_hp,
            'original_nm' => $this->original_nm,
            'tuned_hp' => $this->tuned_hp,
            'tuned_nm' => $this->tuned_nm,
            'ecu' => $this->ecu,
            'ecu_category' => $this->ecu_category,
            'cylinder_capacity' => $this->cylinder_capacity,
            'compression_ratio' => $this->compression_ratio,
            'bore_x_stroke' => $this->bore_x_stroke,
            'engine_number' => $this->engine_number,
            'engine_ecu' => $this->engine_ecu,
            'gearbox' => $this->gearbox,
            'read_methods' => $this->read_methods,
        ];

        if($this->relationLoaded('extraOptions'))  {
            $data['additional_options'] = ExtraOptionResource::collection($this->extraOptions);
        }

        return $data;
    }
}
