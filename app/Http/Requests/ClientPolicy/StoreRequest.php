<?php

namespace App\Http\Requests\ClientPolicy;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'policyClients' => 'required|json',
            //
        ];
    }
    public function messages(): array
    {
        return [
            'client_id.required' => 'El :attribute es obligatorio.',
            'client_id.exists' => 'El :attribute seleccionado no existe.',
            'policyClients.required' => 'las :attribute son obligatorias.',
            'policyClients.json' => 'Las :attribute debe ser un formato json reconocido',
        ];
    }
    public function attributes(): array
    {
        return [
            'client_id' => 'cliente',
            'policyClients' => 'políticas o autorizaciones',
        ];
    }

}
