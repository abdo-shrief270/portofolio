<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTechnologyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'slug'     => 'required|string|max:255|unique:technologies,slug',
            'icon'     => 'nullable|string|max:255',
            'color'    => 'nullable|string|max:20',
            'category' => 'nullable|string|in:frontend,backend,database,devops,other',
            'url'      => 'nullable|url|max:255',
        ];
    }
}
