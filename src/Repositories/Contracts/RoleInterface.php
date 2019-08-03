<?php
namespace Yjtec\Rbac\Repositories\Contracts;
/**
 * @OA\Schema(
 *     schema="RoleModel",
 *     @OA\Property(property="title",type="string",description="角色名称",example="超级管理员"),
 *     @OA\Property(property="name",type="string",description="标识",example="admin"),
 *     @OA\Property(property="remark",type="string",description="描述",example="描述"),
 *     @OA\Property(property="pid",type="integer",description="父级ID(顶级为0）",example="0"),
 * )
 */
interface RoleInterface
{
    //public function list($where);
}