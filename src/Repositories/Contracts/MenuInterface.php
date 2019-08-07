<?php
namespace Yjtec\Rbac\Repositories\Contracts;
/**
 * @OA\Schema(
 *     schema="MenuModel",
 *     @OA\Property(property="title",type="string",description="菜单名称",example="用户管理"),
 *     @OA\Property(property="name",type="string",description="标识",example="user"),
 *     @OA\Property(property="pid",type="integer",description="父级ID(顶级为0）",example="0"),
 *     @OA\Property(property="icon",type="string",description="图标",example="user"),
 *     @OA\Property(property="path",type="string",description="路径",example="/user"),
 *     @OA\Property(property="is_show",type="integer",description="是否显示 1显示默认 0 不显示",example="1"),
 *     @OA\Property(property="is_show_children",type="integer",description="是否显示子菜单 1显示默认 0 不显示",example="1"),
 * )
 */
interface MenuInterface
{
    public function mulDelete($ids);
}