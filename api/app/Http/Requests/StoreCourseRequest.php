<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'             => 'required|string|max:255',
            'institution'      => 'required|string|max:255',
            'completion_date'  => 'nullable|date',
            'certificate_url'  => 'nullable|url|max:255',
            'description'      => 'nullable|string',
            'hours'            => 'nullable|integer|min:0',
            'sort_order'       => 'integer|min:0',
        ];
    }
}
