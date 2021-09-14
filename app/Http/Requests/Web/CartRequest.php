<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class CartRequest extends FormRequest
{


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(sendError($validator->errors()->all()));
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

            'mobile_identifier' => 'required',
            'product_id'        => 'required|exists:products,id',
            'quantity'          => 'required|numeric|between:1,100',
        ];
    }



}
