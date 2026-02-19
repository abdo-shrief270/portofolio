<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company'      => 'sometimes|string|max:255',
            'position'     => 'sometimes|string|max:255',
            'location'     => 'nullable|string|max:255',
            'type'         => 'nullable|string|in:full-time,part-time,contract,freelance,internship',
            'start_date'   => 'sometimes|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'is_current'   => 'boolean',
            'description'  => 'nullable|string',
            'technologies' => 'nullable|array',
            'technologies.*' => 'string|max:100',
            'sort_order'   => 'integer|min:0',
        ];
    }
}
