<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'             => 'sometimes|string|max:255',
            'institution'      => 'sometimes|string|max:255',
            'completion_date'  => 'nullable|date',
            'certificate_url'  => 'nullable|url|max:255',
            'description'      => 'nullable|string',
            'hours'            => 'nullable|integer|min:0',
            'sort_order'       => 'integer|min:0',
        ];
    }
}
