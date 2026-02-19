<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTechnologyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('technology');

        return [
            'name'     => 'sometimes|string|max:255',
            'slug'     => 'sometimes|string|max:255|unique:technologies,slug,' . $id,
            'icon'     => 'nullable|string|max:255',
            'color'    => 'nullable|string|max:20',
            'category' => 'nullable|string|in:frontend,backend,database,devops,other',
            'url'      => 'nullable|url|max:255',
        ];
    }
}
