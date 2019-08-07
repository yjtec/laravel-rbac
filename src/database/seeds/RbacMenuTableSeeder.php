<?php

use Illuminate\Database\Seeder;

class RbacMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title'=>'用户管理','name'=>'user','path'=>'/user','icon'=>'user','pid'=>0],
            ['title'=>'权限管理','name'=>'rbac','path'=>'/rbac','icon'=>'rbac','pid'=>0],
            ['title' => '角色管理','name'=>'role','path'=>'/rbac/role','icon'=>'rbac','pid'=>2],
            ['title' => '权限管理','name'=>'access','path'=>'/rbac/access','icon'=>'rbac','pid'=>2],
            ['title' => '菜单管理','name'=>'menu','path'=>'/rbac/menu','icon'=>'menu','pid'=>2],
        ];
        \Yjtec\Rbac\Models\Menu::insert($data);
    }
}
