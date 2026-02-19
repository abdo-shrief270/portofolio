<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id'     => 'nullable|exists:projects,id',
            'client_name'    => 'sometimes|string|max:255',
            'client_role'    => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'client_avatar'  => 'nullable|string|max:255',
            'content'        => 'sometimes|string',
            'rating'         => 'nullable|integer|min:1|max:5',
            'is_featured'    => 'boolean',
        ];
    }
}
