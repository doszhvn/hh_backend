<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'salary' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'employment_type_id' => ['required', 'integer'],
            'responsibility' => ['required', 'string'],
            'requirements' => ['required', 'string'],
        ];
    }
}
