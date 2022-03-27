<?php

namespace App\Http\Resources\School;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            "created_at" => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
