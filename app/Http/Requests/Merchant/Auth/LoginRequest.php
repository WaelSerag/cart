<?php

namespace App\Http\Requests\Merchant\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class LoginRequest extends FormRequest
{


    protected function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(sendError($validator->errors()));
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             "email"     =>'required|email',
             "password"  =>'required',
        ];
    }


    /**
    *  Filters to be applied to the input.
    *
    * @return array
    */
    public function filters()
    {
        return [
            'email'       => 'trim|escape',
            'password'    => 'trim',
        ];
    }


}
