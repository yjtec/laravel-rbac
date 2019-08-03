<?php
namespace Yjtec\Rbac\Repositories\Contracts;
/**
 * @OA\Schema(
 *     schema="UserModel",
 *     @OA\Property(property="account",type="string",description="账号",example="admin"),
 *     @OA\Property(property="nick_name",type="string",description="昵称",example="admin"),
 *     @OA\Property(property="email",type="string",description="邮箱",example="yjtec@qq.com"),
 *     @OA\Property(property="pwd",type="string",description="密码",example="123456"),
 *     @OA\Property(property="avatar",type="string",description="头像",example="empty.jpeg"),
 * )
 */
interface UserInterface
{
    public function getPwd($account,$pwd);

    public function list($where,$page = false,$width);
    public function disable($where);
    public function enable($where);
}