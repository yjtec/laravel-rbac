<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title'=>'用户管理','name'=>'user','path'=>'/user','icon'=>'user','pid'=>0,'access_id'=>1],
            ['title'=>'权限管理','name'=>'rbac','path'=>'/rbac','icon'=>'rbac','pid'=>0,'access_id'=>2],
            ['title' => '角色管理','name'=>'role','path'=>'/rbac/role','icon'=>'rbac','pid'=>2,'access_id'=>3],
            ['title' => '权限管理','name'=>'access','path'=>'/rbac/access','icon'=>'rbac','pid'=>2,'access_id'=>4],
            ['title' => '菜单管理','name'=>'menu','path'=>'/rbac/menu','icon'=>'menu','pid'=>2,'access_id'=>5],
        ];
    }
}
