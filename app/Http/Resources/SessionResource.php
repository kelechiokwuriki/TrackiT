<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'body_weight' => $this->body_weight,
            'exercises_count' => $this->exercises()->count(),
            'exercises' => $this->exercises,
            'total_weight_lifted_at_session' => $this->exercises()->sum('weight_number'),
            'slug' => $this->slug,
            'created_at' => $this->created_at
        ];
    }
}
