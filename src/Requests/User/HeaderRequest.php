<?php

namespace Yjtec\Rbac\Requests\User;

/**
 * @OA\RequestBody(
 *   request="UploadHeader",
 *   required=true,
 *   description="上传/修改头像",
 *   @OA\MediaType(
 *       mediaType="application/x-www-form-urlencoded",
 *       @OA\Schema(
 *           @OA\Property(property="avatar",type="file",description="头像",example="test.jpg"),
 *       )
 *   )
 * )
 */
class HeaderRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar'   => 'required|file|mimes:png,jpg,jpeg',
        ];
    }
}
