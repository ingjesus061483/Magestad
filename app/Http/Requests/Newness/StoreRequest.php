<?php

namespace App\Http\Requests\Newness;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $newnessType = explode('-', $this->newness_type_id);
        $client = explode('-', $this->client_id);
        $this->merge([
            'newness_type_id' => trim($newnessType[0]),
            'client_id' => trim($client[0]),
        ]);
    }
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
            'user_id'=>'required|exists:users,id',
            'date'=>'required|date',
            'client_id'=>'required|exists:clients,id',
            'newness_type_id'=>'required|exists:newness_types,id',
            'remark'=>'required|string|max:255',
                  //
        ];
    }
    public function messages()
    {
        return [
            'user_id.required' => 'El :attribute es obligatorio.',
            'user_id.exists' => 'El :attribute no existe.',
            'date.required' => 'La :attribute es obligatoria.',
            'date.date' => 'La :attribute no es una fecha valida.',
            'client_id.required' => 'El :attribute es obligatorio.',
            'client_id.exists' => 'El :attribute no existe.',
            'newness_type_id.required' => 'El :attribute es obligatorio.',
            'newness_type_id.exists' => 'El :attribute no existe.',
            'remark.required' => 'La :attribute es obligatoria.',
            'remark.string' => 'La :attribute debe ser una cadena de texto.',
            'remark.max' => 'La :attribute no debe ser mayor a 255 caracteres.',
        ];
    }
    public function attributes()
    {
        return [
            'user_id' => 'usuario',
            'date' => 'fecha',
            'client_id' => 'cliente',
            'newness_type_id' => 'tipo de novedad',
            'remark' => 'observacion',

        ];
    }

}
