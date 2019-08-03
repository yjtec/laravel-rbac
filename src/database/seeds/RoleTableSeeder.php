<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
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
            ['title' => '普通管理员','name'=>'user','remark' => '普通管理员','pid' => 0],
            ['title' => '文案','name'=>'article','remark' => '文案', 'pid' => 2],
            ['title' => '财务','name'=>'finance','remark' => '财务', 'pid' => 2],
            ['title' => '人事','name'=>'humans','remark' => '人事', 'pid' => 2],
        ];

        
        \Yjtec\Rbac\Models\Role::insert($data);
    }
}
