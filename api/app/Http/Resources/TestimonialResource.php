<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
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
            'client_name' => $this->client_name,
            'client_role' => $this->client_role,
            'client_company' => $this->client_company,
            'client_avatar' => $this->client_avatar,
            'content' => $this->content,
            'rating' => $this->rating,
            'is_featured' => $this->is_featured,
            'project' => new ProjectResource($this->whenLoaded('project')),
            'created_at' => $this->created_at,
        ];
    }
}
