<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'provider' => $this->provider,
            'instructor' => $this->instructor,
            'description' => $this->description,
            'certificate_url' => $this->certificate_url,
            'course_url' => $this->course_url,
            'completed_at' => $this->completed_at?->format('Y-m-d'),
            'duration_hours' => $this->duration_hours,
            'skills_learned' => $this->skills_learned,
            'thumbnail' => $this->thumbnail,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
