<?php

namespace Yjtec\Rbac\Requests\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use Yjtec\Pwd\Pwd;

/**
 * @OA\RequestBody(
 *   request="UpdateUser",
 *   required=true,
 *   description="修改用户请求提",
 *   @OA\MediaType(
 *       mediaType="application/x-www-form-urlencoded",
 *       @OA\Schema(
 *           @OA\Property(property="nick_name",type="string",description="昵称",example="admin"),
 *           @OA\Property(property="email",type="string",description="邮箱"),
 *           @OA\Property(property="pwd",type="string",description="密码（为空不修改）"),
 *       )
 *   )
 * )
 */
class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->route('user');
        return [
            'email'     => [
                'required',
                'email',
                Rule::unique(config('rbac.connection').'.users')->ignore($user->id),
            ],
            'nick_name' => 'sometimes|min:4|max:20',
            'status'    => 'sometimes|in:0,1',
            'avatar'    => 'sometimes',
        ];
    }

    public function withValidator($validator)
    {
        $validator->sometimes('pwd', 'min:6', function ($data) {
            return $data->pwd;
        });
        $validator->after(function ($validator) {
            if (empty($validator->errors()->all())) {
                $inputPwd = $this->input('pwd');
                if($inputPwd){
                    $pwd      = Pwd::build($inputPwd);
                    $this->merge([
                        'password' => $pwd['pwd'],
                        'salt'     => $pwd['salt'],
                    ]);
                }
            }
        });
    }
}
