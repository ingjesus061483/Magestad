<?php

namespace App\Http\Requests\EmploymentInformation;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function prepareForValidation()
    {
          $cur= str_replace('$','',$this->average_monthly_salary) ;
       $average_monthly_salary=str_replace(',','', str_replace('.00','',$cur));

        $this->merge([
            'average_monthly_salary' => $average_monthly_salary,
        ]);
    }
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
            'company_works'=>'max:100',
            'nit_company_works'=>'max:50',
            'main_address'=>'required|max:50',
            'city'=>'required',
            'state'=>'required',
            'entry_date'=>'required',
            'average_monthly_salary'=>'required|max:20',
            'current_position'=>'required',
            'payment_frequency'=>'required',
            'company_payment_date'=>'required',
            'custemer_payment_date'=>'required',
            'contract_type'=>'required',
            'eps_affiliate'=>'required',
            'arl_affiliate'=>'required',
            'occupational_position'=>'required|exists:occupational_positions,id'

            //
        ];
    }
    public function messages()
    {
        return [
            'client_id.required' => 'El :attribute es obligatorio.',
           // 'company_works.required' => 'El :attribute es obligatorio.',
            'company_works.max' => 'El :attribute no debe ser mayor a 100 caracteres.',
            //'nit_company_works.required' => 'El :attribute es obligatorio.',
            'nit_company_works.max' => 'El :attribute no debe ser mayor a 50 caracteres.',
            'main_address.required' => 'El :attribute es obligatorio.',
            'main_address.max' => 'El :attribute no debe ser mayor a 50 caracteres.',
            'city.required' => 'La :attribute es obligatoria.',
            'state.required' => 'El :attribute es obligatorio.',
            'entry_date.required' => 'El :attribute es obligatorio.',
            'average_monthly_salary.required' => 'El :attribute es obligatorio.',
            'average_monthly_salary.max' => 'El :attribute no debe ser mayor a 20 caracteres.',
            'current_position.required' => 'El :attribute es obligatorio.',
            'payment_frequency.required' => 'El :attribute es obligatorio.',
            'company_payment_date.required' => 'El :attribute es obligatorio.',
            'custemer_payment_date.required' => 'El :attribute es obligatorio.',
            'contract_type.required' => 'El :attribute es obligatorio.',
            'eps_affiliate.required' => 'El :attribute es obligatorio.',
            'arl_affiliate.required' => 'El :attribute es obligatorio.',
                        'occupational_position.required'=>'La :attribute es obligatorio'

        ];
    }
    public function attributes()
    {
        return [
            'client_id' => 'cliente',
//            'company_works' => 'empresa donde labora',
            'nit_company_works' => 'NIT de la empresa donde labora',
            'main_address' => 'dirección principal de la empresa',
            'city' => 'ciudad',
            'state' => 'departamento',
            'entry_date' => 'fecha de ingreso',
            'average_monthly_salary' => 'salario mensual promedio',
            'current_position' => 'cargo actual',
            'payment_frequency' => 'frecuencia de pago',
            'company_payment_date' => 'fecha de pago de la empresa',
            'custemer_payment_date' => 'fecha de pago del cliente',
            'contract_type' => 'tipo de contrato',
            'eps_affiliate' => 'EPS a la que está afiliado',
            'arl_affiliate' => 'ARL a la que está afiliado',
        ];
    }
}
