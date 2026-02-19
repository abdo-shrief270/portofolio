<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('category');

        return [
            'name'        => 'sometimes|string|max:255',
            'slug'        => 'sometimes|string|max:255|unique:categories,slug,' . $id,
            'description' => 'nullable|string|max:500',
            'icon'        => 'nullable|string|max:100',
            'sort_order'  => 'integer|min:0',
        ];
    }
}
