<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'position'    => 'nullable|string|max:255',
            'company'     => 'nullable|string|max:255',
            'avatar'      => 'nullable|string|max:500',
            'content'     => 'required|string|max:2000',
            'rating'      => 'required|integer|min:1|max:5',
            'is_featured' => 'boolean',
            'sort_order'  => 'integer|min:0',
        ];
    }
}
