<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
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
            'event_type'=>'required|exists:event_types,id',
            'date'=>'required|date',
            'time'=>'required',
            'title'=>'required|max:50'
            //
        ];
    }
    public function messages(): array
    {
        return [
            'event_type.required' => 'El :attribute es requerido',
            'event_type.exists' => 'El :attribute seleccionado no existe',
            'date.required' => 'La :attribute es requerida',
            'date.date' => 'La :attribute debe ser una fecha válida',
            'time.required' => 'La :attribute es requerida',
            'title.required' => 'La :attribute es requerida',
        ];
    }
    public function attributes(): array
    {
        return [
            'event_type' => 'tipo de evento',
            'date' => 'fecha',
            'time' => 'hora',
            'title' => 'titulo',
            ];
    }
}
