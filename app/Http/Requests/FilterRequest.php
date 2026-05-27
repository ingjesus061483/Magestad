<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
class FilterRequest extends FormRequest
{
     protected function failedAuthorization()
    {
        throw new HttpResponseException(response()->redirectTo(url('/UnAutorize'))
        ->with(['error' => 'Esta accion no esta autorizada!']));
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
          if($this->firstdate==null||$this->enddate==null)
        {
            return[];

        }
        return [
            'firstdate'=>'date',
            'enddate'=>'date|after_or_equal:firstdate'                       //
        ];
    }
    public function messages()
    {
        return [
            'firstdate.date' => 'La :attribute debe ser una fecha válida.',
            'enddate.date' => 'La :attribute debe ser una fecha válida.',
            'enddate.after_or_equal' => 'La :attribute debe ser igual o posterior a la fecha de inicio.',
        ];
    }
    public function attributes()
    {
        return [
            'firstdate' => 'fecha de inicio',
            'enddate' => 'fecha final',
        ];
    }
}
