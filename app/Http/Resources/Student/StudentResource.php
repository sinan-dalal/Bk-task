<?php

namespace App\Http\Resources\Student;

use App\Http\Resources\School\SchoolResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'school' => new SchoolResource($this->whenLoaded('school')),
            "created_at" => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
