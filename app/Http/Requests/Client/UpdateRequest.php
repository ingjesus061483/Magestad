<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'city_id'=>'required|exists:cities,id',
            'identification'=>'required|max:50|unique:clients,identification,'.$this->id,
            'name_last_name'=>'required|max:100',
            'address'=>'required|max:100',
            'email'=>'required|email|max:50',
            'birth_date'=>'required',
            'expedition_date'=>'required',
            'neighborhood'=>'required|max:50',
            'quality_holder'=>'required',
            'marital_status' => 'required',
            'study_level' =>'required',
            //
        ];
    }
    public function messages()
    {
        return [
            'city_id.exists' => 'La :attribute seleccionada no es válida.',
            'city_id.required' => 'La :attribute es obligatoria.',
            'identification.required' => 'La :attribute es obligatoria.',
            'identification.unique' => 'La :attribute ya está registrada.',
            'identification.max' => 'La :attribute no debe ser mayor a 50 caracteres.',
            'name_last_name.required' => 'El :attribute es obligatorio.',
            'name_last_name.max' => 'El :attribute no debe ser mayor a 100 caracteres.',
            'address.required' => 'La :attribute es obligatoria.',
            'address.max' => 'La :attribute no debe ser mayor a 100 caracteres.',
            'email.required' => 'El :attribute es obligatorio.',
            'email.email' => 'El :attribute debe ser una dirección de correo válida.',
            'email.max' => 'El :attribute no debe ser mayor a 50 caracteres.',
            'birth_date.required' => 'La :attribute es obligatoria.',
            'expedition_date.required' => 'La :attribute es obligatoria.',
            'neighborhood.required' => 'El :attribute es obligatorio.',
            'neighborhood.max' => 'El :attribute no debe ser mayor a 50 caracteres.',
            'marital_status.required' => 'El :attribute es obligatorio.',
            'study_level.required' => 'El :attribute es obligatorio.',
            'quality_holder.required' => 'El :attribute es obligatorio.',
        ];
    }
    public function attributes()
    {
        return [
            'city_id' => 'ciudad',
            'identification' => 'identificación',
            'name_last_name' => 'nombre y apellido',
            'address' => 'dirección',
            'email' => 'correo electrónico',
            'birth_date' => 'fecha de nacimiento',
            'expedition_date' => 'fecha de expedición',
            'neighborhood' => 'barrio',
            'marital_status' => 'estado civil',
            'study_level' => 'nivel de estudios',
            'quality_holder' => 'calidad del titular',
        ];
    }

}
