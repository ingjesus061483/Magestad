<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date'=>'required|date|exists:events,date'
            //
        ];
    }
    public function messages(): array
    {
        return [
            'date.required' => 'La :attribute es requerida',
            'date.date' => 'La :attribute debe ser una fecha válida',
            'date.exists' => 'No se ha encontrado un evento con la :attribute ingresada',
        ];
    }
    public function attributes(): array
    {
        return [
            'date' => 'fecha',
        ];
    }
}
