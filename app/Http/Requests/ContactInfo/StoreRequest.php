<?php

namespace App\Http\Requests\ContactInfo;

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
       if($this->action=="guardar")
       {
            return [
                'client_id'=>'required',
                'phone'=>'required|max:20',
                'phone_type'=>'required|max:50',
                //
            ];
       }
        return [
            //
        ];
    }
    public function messages()
    {
        return [
            'client_id.required' => 'El :attribute es obligatorio.',
            'phone.required' => 'El :attribute es obligatorio.',
            'phone.max' => 'El :attribute no debe ser mayor a 20 caracteres.',
            'phone_type.required' => 'El :attribute es obligatorio.',
            'phone_type.max' => 'El :attribute no debe ser mayor a 50 caracteres.',
        ];
    }
    public function attributes()
    {
        return [
            'client_id' => 'cliente',
            'phone' => 'teléfono',
            'phone_type' => 'tipo de teléfono',

        ];
    }
}
