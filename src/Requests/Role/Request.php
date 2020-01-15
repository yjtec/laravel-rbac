<?php
namespace Yjtec\Rbac\Requests\Role;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title'  => '角色名称',
            'name'   => '标识',
            'pid'    => '父级ID',
            'remark' => '描述',
        ];
    }
}
