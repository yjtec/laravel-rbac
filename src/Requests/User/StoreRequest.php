<?php

namespace Yjtec\Rbac\Requests\User;

use Yjtec\Pwd\Pwd;

/**
 * @OA\RequestBody(
 *   request="StoreUser",
 *   required=true,
 *   description="新增用户请求提",
 *   @OA\MediaType(
 *       mediaType="application/x-www-form-urlencoded",
 *       @OA\Schema(ref="#/components/schemas/UserModel")
 *   )
 * )
 */
class StoreRequest extends Request
{

    public function rules()
    {
        return [
            'account'     => 'required|min:4|unique:'.config('rbac.connection').'.users,account',
            'email'       => 'required|email|unique:'.config('rbac.connection').'.users',
            'pwd'         => 'required|min:6',
            'roles'       => 'required|exists:'.config('rbac.connection').'.roles,id',
            'nick_name'   => 'required|min:4|max:20',
            'avatar'      => 'sometimes',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (empty($validator->errors()->all())) {
                //做密码处理
                $inputPwd = $this->input('pwd');
                $pwd      = Pwd::build($inputPwd);
                $this->merge([
                    'password' => $pwd['pwd'],
                    'salt'     => $pwd['salt'],
                ]);
            }
        });
    }
}
