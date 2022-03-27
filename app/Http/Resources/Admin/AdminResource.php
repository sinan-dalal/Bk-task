<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "created_at" => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
