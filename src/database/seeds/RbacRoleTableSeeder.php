<?php

use Illuminate\Database\Seeder;

class RbacRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title' => '超级管理员','name'=>'admin','remark' => '超级管理员', 'pid' => 0],
            ['title' => '普通管理员','name'=>'user','remark' => '普通管理员','pid' => 0]
        ];

        
        \Yjtec\Rbac\Models\Role::insert($data);
    }
}
