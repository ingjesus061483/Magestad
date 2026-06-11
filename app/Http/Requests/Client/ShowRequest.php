<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
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
        if($this->has('identification'))
        {
        return [
            'identification' => 'required|exists:clients,identification',
            //
        ];
        }
        return [

            //
        ];
    }
    public function messages(): array
    {
        return [
            'identification.required' => 'La :attribute es requerida',
            'identification.exists' => 'La :attribute no existe en la base de datos',
        ];
    }
    public function attributes(): array
    {
        return [
            'identification' => 'identificación',
        ];
    }
}
