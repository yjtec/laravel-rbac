<?php
namespace Yjtec\Rbac\Repositories\Contracts;
/**
 * @OA\Schema(
 *     schema="AccessModel",
 *     @OA\Property(property="title",type="string",description="权限名称",example="管理员管理"),
 *     @OA\Property(property="remark",type="string",description="权限描述",example="权限描述"),
 *     @OA\Property(property="name",type="string",description="权限名称(英文)",example="Manager"),
 *     @OA\Property(property="pid",type="integer",description="父级ID(顶级为0）",example="0"),
 *     @OA\Property(property="level",type="integer",description="应用等级：1 App 2 module 3 method 4 action",example="0"),
 * )
 */
interface AccessInterface
{
    
}