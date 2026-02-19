<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company'           => 'required|string|max:255',
            'position'          => 'required|string|max:255',
            'location'          => 'nullable|string|max:255',
            'type'              => 'required|in:full_time,part_time,contract,freelance,internship',
            'start_date'        => 'required|date',
            'end_date'          => 'nullable|date|after:start_date',
            'is_current'        => 'boolean',
            'description'       => 'nullable|string|max:2000',
            'responsibilities'  => 'nullable|array',
            'responsibilities.*'=> 'string|max:500',
            'technologies_used' => 'nullable|array',
            'technologies_used.*' => 'string|max:100',
            'sort_order'        => 'integer|min:0',
        ];
    }
}
