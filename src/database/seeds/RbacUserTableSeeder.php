<?php

use Illuminate\Database\Seeder;
use \Yjtec\Rbac\Models\User;
use Yjtec\Pwd\Pwd;
class RbacUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!User::where('account','admin')->first()){
            $pwd = Pwd::build('123456');

            User::insert([
                'account' =>'admin',
                'avatar' => 'empty.jpg',
                'nick_name' => '超级管理员',
                'salt' => $pwd['salt'],
                'email' => 'mail@qq.com',
                'status' => 1,
                'password' => $pwd['pwd'],
                'api_token' => str_random(60)
            ]);
        }
    }
}
