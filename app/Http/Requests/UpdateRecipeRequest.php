<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:10|max:50',
            'description' => 'required|string|min:50|max:500',
            'prep_time' => 'required|integer|max_digits:3',
            'instructions' => 'required|string|min:50',
            'image' => 'image',

            'ingredients' => 'required|array',
            'ingredients.*' => 'filled',
            'new_ingredients' => 'array',
            'new_ingredients.*' => 'filled',
            'amounts' => 'required|array',
            'amounts.*' => 'filled|string',
            'new_amounts' => 'array',
            'new_amounts*' => 'filled',
        ];
    }

    public function messages()
    {
        return [
            'amounts.*' => 'Alle amounts moeten worden ingevuld',
            'new_amounts.*' => 'Alle amounts moeten worden ingevuld',
        ];
    }
}
