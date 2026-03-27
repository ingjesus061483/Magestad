<?php

namespace App\Http\Requests\Document;

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

        'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'document_type' => 'required|exists:document_types,id',
        'client' => 'required|exists:clients,id',
        'description'=>'required|max:100'
            //
        ];
    }
    public function messages()
    {
        return [

            'file.required' => 'El :attribute es obligatorio.',
            'file.file' => 'El :attribute debe ser un archivo válido.',
            'file.mimes' => 'El :attribute debe ser un archivo de tipo: pdf, jpg, jpeg, png.',
            'file.max' => 'El :attribute no debe ser mayor a 2MB.',
            'document_type_id.required' => 'El :attribute es obligatorio.',
            'document_type_id.exists' => 'El :attribute seleccionado no es válido.',
            'client_id.required' => 'El :attribute es obligatorio.',
            'client_id.exists' => 'El :attribute seleccionado no es válido.',
            'description.required'=>'La :attribute es obligatoria.',
            'description.max'=>'La :attribute no debe ser mayor a 100 carácteres.'
        ];
    }
    public function attributes()
    {
        return [

            'file' => 'archivo del documento',
            'document_type_id' => 'tipo de documento',
            'client_id' => 'cliente',
            'description'=>'descripción'
        ];
    }
}
