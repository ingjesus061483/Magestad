<?php

namespace App\Http\Requests\RequestLoan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
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
                'date' => 'required|date',
                'clientName' => 'required|string|max:50',
                'amountRequested' => 'required|numeric|min:0',
                'priority' => 'required|exists:priorities,id',
             //
            //
        ];
    }
    public function messages()
    {
        return [
            'date.required' => 'La :attribute es obligatoria.',
            'date.date' => 'La :attribute debe ser una fecha válida.',
            'clientName.required' => 'El :attribute es obligatorio.',
            'clientName.string' => 'El :attribute debe ser una cadena de texto.',
            'clientName.max' => 'El :attribute no puede exceder los 50 caracteres.',
            'amountRequested.required' => 'El :attribute es obligatorio.',
            'amountRequested.numeric' => 'El :attribute debe ser un número.',
            'amountRequested.min' => 'El :attribute debe ser al menos 0.',
            'priority_id.required' => 'La :attribute es obligatoria.',
            'priority_id.exists' => 'La :attribute seleccionada no es válida.',
        ];
    }
    public function attributes()
    {        return [
            'date' => 'fecha',
            'clientName' => 'nombre del cliente',
            'amountRequested' => 'monto solicitado',
            'priority_id' => 'prioridad',
        ];
    }
    public function prepareForValidation()
    {
        $cur= str_replace('$','',$this->amountRequested) ;
        $ammount=str_replace(',','', str_replace('.00','',$cur));
        $this->merge([
              'amountRequested' => $ammount,
         ]);

    }
}
