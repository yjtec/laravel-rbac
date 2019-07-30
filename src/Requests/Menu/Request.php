<?php

namespace Yjtec\Rbac\Requests\Menu;

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
            'title'            => '菜单名称',
            'name'             => '英文名称',
            'pid'              => '父级ID',
            'icon'             => '图标',
            'path'             => '路径',
            'is_show'          => '是否显示',
            'is_show_children' => '是否显示子类',
        ];
    }
}
