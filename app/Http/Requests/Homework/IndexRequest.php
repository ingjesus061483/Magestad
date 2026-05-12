<?php

namespace App\Http\Requests\Homework;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class IndexRequest extends FormRequest
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
          if($this->firstdate==null||$this->enddate==null)
        {
            return[];

        }
        return [
            'firstdate'=>'date',
            'enddate'=>'date|after_or_equal:firstdate'



            //
        ];
    }
}
