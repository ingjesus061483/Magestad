<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Override;

class ImportRequest extends FormRequest
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
            'file'=>'required|file|mimes:xls,xlsx'
            //
        ];
    }
    public function messages(){
        return [
            'file.required' => 'El :attribute es obligatorio.',
            'file.file' => 'El :attribute debe ser un archivo.',
            'file.mimes' => 'El :attribute debe ser un archivo de tipo xls o xlsx.',
        ];
    }
    #[Override]
    public function attributes()
    {
        return [
            'file' => 'archivo',
        ];

    }
     protected function failedAuthorization()
    {

        throw new HttpResponseException(response()->redirectTo(url('/UnAutorize'))
            ->with(['error' => 'Esta accion no esta autorizada!']));
    }
}
