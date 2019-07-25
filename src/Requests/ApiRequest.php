<?php

namespace Yjtec\Rbac\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->all();
        //dd($error);
        throw new HttpResponseException(
            response()->json([
                'errmsg'  => $validator->errors()->first(),
                'errcode' => 422,
            ])
        );
    }
}
