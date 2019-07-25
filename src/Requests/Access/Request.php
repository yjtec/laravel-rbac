<?php

namespace Yjtec\Rbac\Requests\Access;

use App\Http\Requests\ApiRequest;

class Request extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'title' => '名称',
            'name'  => '英文名称',
            'pid'   => '父级ID',
        ];
    }
}
