<?php

namespace Yjtec\Rbac\Requests\Menu;

class UpdateRequest extends Request
{

    public function rules()
    {
        return [
            'title' => 'sometimes|required|min:4|max:10',
            'name' => 'sometimes|required|min:4|max:25',
            'pid' => 'sometimes|sometimes|numeric'
        ];
    }
}
