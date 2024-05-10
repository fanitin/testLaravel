<?php

namespace App\Http\Requests\Result;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kwota' => 'required|numeric',
            'years' => 'required|numeric',
            'procent' => 'required|numeric',
            'phone' => 'required|string|regex:/^\+48[0-9]{9}$/',
            'category_id' => 'required|numeric',
            'tags' => ''
        ];
    }
}
