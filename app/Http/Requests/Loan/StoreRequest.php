<?php

namespace App\Http\Requests\Loan;

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
            'client_id'=>'required',
            'ammount'=>'required|max:20',
            'term'=>'required|numeric',
            'warranty'=>'required',
            'loan_type'=>'required',
            //
        ];
    }
    public function messages()
    {
        return [
            'loan_type.required'=>'El :attribute es obligatorio',
            'client_id.required' => 'El :attribute es obligatorio.',
            'ammount.required' => 'El :attribute es obligatorio.',
            'ammount.max' => 'El :attribute no debe ser mayor a 20 caracteres.',
            'term.required' => 'El :attribute es obligatorio.',
            'term.numeric' => 'El :attribute debe ser un número.',
            'warranty.required' => 'El :attribute es obligatorio.',
        ];
    }
    public function prepareForValidation()
    {
         $cur= str_replace('$','',$this->ammount) ;
       $ammount=str_replace(',','', str_replace('.00','',$cur));
         $this->merge([
              'ammount' => $ammount,
         ]);


    }
    public function attributes()
    {
        return [
            'client_id' => 'cliente',
            'ammount' => 'monto',
            'term' => 'plazo',
            'warranty' => 'garantía',
            'loan_type'=>'tipo de credto'
        ];
    }
}
