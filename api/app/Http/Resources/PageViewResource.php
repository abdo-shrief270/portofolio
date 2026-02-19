<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageViewResource extends JsonResource
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
            'page' => $this->page,
            'ip_hash' => $this->ip_hash,
            'referrer' => $this->referrer,
            'user_agent' => $this->user_agent,
            'country' => $this->country,
            'project' => new ProjectResource($this->whenLoaded('project')),
            'created_at' => $this->created_at,
        ];
    }
}
