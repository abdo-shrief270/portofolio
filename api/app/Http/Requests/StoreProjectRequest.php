<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'             => 'required|string|max:255',
            'slug'              => 'required|string|max:255|unique:projects,slug',
            'subtitle'          => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'status'            => 'required|in:live,in_progress,completed,archived,draft',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'demo_url'          => 'nullable|url|max:255',
            'github_url'        => 'nullable|url|max:255',
            'subdomain'         => 'nullable|string|max:63|alpha_dash',
            'thumbnail'         => 'nullable|string|max:500',
            'gallery'           => 'nullable|array',
            'gallery.*'         => 'string|max:500',
            'tech_stack'        => 'nullable|array',
            'tech_stack.*'      => 'string|max:100',
            'features'          => 'nullable|array',
            'features.*'        => 'array',
            'features.*.title'  => 'required_with:features.*|string|max:255',
            'features.*.description' => 'nullable|string|max:1000',
            'features.*.icon'   => 'nullable|string|max:100',
            'seo'               => 'nullable|array',
            'seo.title'         => 'nullable|string|max:70',
            'seo.description'   => 'nullable|string|max:160',
            'seo.keywords'      => 'nullable|array',
            'seo.keywords.*'    => 'string|max:50',
            'seo.og_image'      => 'nullable|string|max:500',
            'category_id'       => 'nullable|exists:categories,id',
            'technology_ids'    => 'nullable|array',
            'technology_ids.*'  => 'exists:technologies,id',
            'sort_order'        => 'integer|min:0',
        ];
    }
}
