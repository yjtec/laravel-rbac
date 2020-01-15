<?php

namespace Yjtec\Rbac\Requests\User;

use Yjtec\Rbac\Requests\ApiRequest;

class Request extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'account'   => '账号',
            'nick_name' => '昵称',
            'email'     => '邮箱',
            'pwd'       => '密码',
            'role'      => '角色',
            'avatar'    => '头像',
        ];
    }

}
