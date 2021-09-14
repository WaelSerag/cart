<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class ProductRequest extends FormRequest
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
            "name"         =>'required|string|max:190|unique:products,name',
            "description"  =>'required',
            "price"        =>'required|numeric|between:0,100000',
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
            'name'         => 'trim|escape',
            'description'  => 'trim|escape',
            'price'        => 'trim|escape',
        ];
    }

}
