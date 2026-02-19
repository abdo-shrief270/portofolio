<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'status' => $this->status,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
            'demo_url' => $this->demo_url,
            'subdomain' => $this->subdomain,
            'subdomain_status' => $this->subdomain_status,
            'github_url' => $this->github_url,
            'thumbnail' => $this->thumbnail,
            'gallery' => $this->gallery,
            'tech_stack' => $this->tech_stack,
            'features' => $this->features,
            'seo' => [
                'title' => $this->seo_title,
                'description' => $this->seo_description,
                'keywords' => $this->seo_keywords,
                'og_image' => $this->og_image,
            ],
            'category' => new CategoryResource($this->whenLoaded('category')),
            'technologies' => TechnologyResource::collection($this->whenLoaded('technologies')),
            'testimonials' => TestimonialResource::collection($this->whenLoaded('testimonials')),
            'sort_order' => $this->sort_order,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
