<?php

namespace Yjtec\Rbac\Requests\Access;

/**
 * @OA\RequestBody(
 *   request="StoreAccess",
 *   required=true,
 *   description="新增权限请求体",
 *   @OA\MediaType(
 *       mediaType="application/x-www-form-urlencoded",
 *       @OA\Schema(ref="#/components/schemas/AccessModel")
 *   )
 * )
 */
class StoreRequest extends Request
{

    public function rules()
    {
        return [
            'title' => 'required|min:4|max:10',
            'name' => 'required|min:4|max:25',
            'pid' => 'sometimes|numeric'
        ];
    }
}
