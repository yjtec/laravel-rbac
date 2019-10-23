<?php

namespace Yjtec\Rbac\Requests\User;

use Illuminate\Validation\Rule;

/**
 * @OA\RequestBody(
 *   request="LoginUser",
 *   required=true,
 *   description="新增用户请求提",
 *   @OA\MediaType(
 *       mediaType="application/x-www-form-urlencoded",
 *       @OA\Schema(
 *           @OA\Property(
 *               property="account",
 *               type="string",
 *               description="用户名",
 *               example="admin"
 *           ),
 *           @OA\Property(
 *               property="pwd",
 *               type="string",
 *               description="密码(md5加密)",
 *               example="e10adc3949ba59abbe56e057f20f883e"
 *           ),
 *       )
 *   )
 * )
 */
class LoginRequest extends Request
{
    // public function authorize()
    // {
    //     return Auth::attempt(['account'=>'admin1','sdf'=>'123']);
    // }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //dd($this->input('account'));
        return [
            'account' => [
                'required',
                //'exists:rbac.users',
                Rule::exists(config('rbac.connection') . '.users')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'pwd'     => 'required|pwd:' . config('rbac.connection') . '.users,account',
        ];
    }

    public function messages()
    {
        return [
            'account.exists' => '账号不存在！',
            'pwd.pwd'        => '密码错误',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (empty($validator->errors()->all())) {
                $userRepo = resolve('Yjtec\Rbac\Repositories\Contracts\UserInterface');
                $user     = $userRepo->findByField('account', $this->input('account'));
                $this->merge(['user' => $user]);
            }
        });
    }
}
