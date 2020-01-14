<?php

namespace Yjtec\Rbac\Requests\Menu;

/**
 * @OA\RequestBody(
 *   request="StoreMenu",
 *   required=true,
 *   description="新增菜单请求体",
 *   @OA\MediaType(
 *       mediaType="application/x-www-form-urlencoded",
 *       @OA\Schema(ref="#/components/schemas/MenuModel")
 *   )
 * )
 */
class StoreRequest extends Request
{

    public function rules()
    {
        return [
            'title' => 'required|min:2|max:10',
            'name' => 'required|min:2|max:25',
            'pid' => 'sometimes|numeric'
        ];
    }
}
