<?php

namespace Yjtec\Rbac\Requests\Access;

/**
 * @OA\RequestBody(
 *   request="UpdateAccess",
 *   required=true,
 *   description="修改权限请求体",
 *   @OA\MediaType(
 *       mediaType="application/x-www-form-urlencoded",
 *       @OA\Schema(ref="#/components/schemas/AccessModel")
 *   )
 * )
 */
class UpdateRequest extends Request
{

    public function rules()
    {
        return [
            'title' => 'sometimes|required|min:4|max:10',
            'name' => 'sometimes|required|min:4|max:25',
            'pid' => 'sometimes|numeric',
        ];
    }
}
