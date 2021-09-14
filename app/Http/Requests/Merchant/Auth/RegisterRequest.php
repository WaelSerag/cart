<?php

namespace App\Http\Requests\Merchant\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class RegisterRequest extends FormRequest
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
             "name"       =>'required|string|max:190',
             "email"      =>'required|email|unique:users,email',
             "password"   =>'required|min:6',
             "store_name" =>'required|string|max:190|unique:stores,name',
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
            'name'        => 'trim|escape',
            'email'       => 'trim|escape',
            'password'    => 'trim',
            'store_name'  => 'trim|escape',
        ];
    }


}
