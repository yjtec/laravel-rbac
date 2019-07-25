<?php

namespace Yjtec\Rbac\Requests\Role;

class DestoryRequest extends Request
{
    public function rules()
    {
        return [];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $role = $this->route('role');
            if($role->users->isNotEmpty()){
                $validator->errors()->add('id', '此角色用户正在使用，不得删除');
            }
        });
    }
}
