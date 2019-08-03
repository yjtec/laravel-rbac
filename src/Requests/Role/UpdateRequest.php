<?php

namespace Yjtec\Rbac\Requests\Role;

class UpdateRequest extends Request
{
    public function rules()
    {
        return [
            'title' => 'sometimes|min:2|max:255',
            'name' => 'sometimes|min:2|max:255',
            'remark' => 'sometimes|min:2|max:255',
            'pid' => 'sometimes|numeric'
        ];
    }
}
