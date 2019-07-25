<?php

namespace Yjtec\Rbac\Requests\Role;
class StoreRequest extends Request
{
/**
 * @OA\RequestBody(
 *   request="StoreRole",
 *   required=true,
 *   description="新增角色请求体",
 *   @OA\MediaType(
 *       mediaType="application/x-www-form-urlencoded",
 *       @OA\Schema(ref="#/components/schemas/RoleModel")
 *   )
 * )
 */
    public function rules()
    {
        return [
            'title'=>'required|min:2|max:10',
            'remark' => 'required|min:2|max:255',
            'pid'=>"sometimes|numeric"
        ];
    }
}
