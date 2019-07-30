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
            ['title' => '超级管理员','remark' => '超级管理员', 'pid' => 0, 'app_id' => '123'],
            ['title' => '普通管理员', 'remark' => '普通管理员','pid' => 0, 'app_id' => '123'],
            ['title' => '文案','remark' => '文案', 'pid' => 2, 'app_id' => '123'],
            ['title' => '财务','remark' => '财务', 'pid' => 2, 'app_id' => '123'],
            ['title' => '人事','remark' => '人事', 'pid' => 2, 'app_id' => '123'],
        ];

        
        \App\Models\Role::insert($data);
    }
}
