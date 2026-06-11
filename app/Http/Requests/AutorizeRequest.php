<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Override;

class AutorizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }
    // Source - https://stackoverflow.com/questions/49403226/redirect-if-request-authorization-is-failed-in-laravel
// Posted by dgregory
// Retrieved 4/11/2025, License - CC-BY-SA 4.0
    protected function failedAuthorization()
    {
        throw new HttpResponseException(response()->redirectTo(url('/UnAutorize'))
        ->with(['error' => 'Esta accion no esta autorizada!']));
    }
     public function prepareForValidation(){
        if($this->has('info'))
        {
            $this->merge([
                'info' =>trim(explode('-',$this->info)[0])
            ]);
        }
     }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            //
        ];
    }
}
