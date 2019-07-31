<?php

use Illuminate\Database\Seeder;

class AccessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appId = env('APP_KEY');
        $data = [
            [
                'title' => '后台应用',
                'name' => 'Admin',
                'level' => 1,
                'children' => [
                    [
                        'title' => '用户管理',
                        'name' => 'User',
                        'level' => 2,
                        'children' => [
                            [
                                'title'=>'用户列表',
                                'name' => 'List',
                                'level' => 3,
                                'children' => [
                                    ['title' => '新增用户','name' =>'add','level' => 4],
                                    ['title' => '删除用户','name' =>'delete','level' => 4],
                                    ['title' => '编辑用户','name' =>'edit','level'=>4],
                                ]
                            ],
                            [
                                'title' => '编辑用户',
                                'name' => 'Edit',
                                'level' => 3
                            ],
                            [
                                'title' => '新增用户',
                                'name' => 'Add',
                                'level' => 3
                            ],
                            [
                                'title' => '删除用户',
                                'name' => 'DELETE',
                                'level' => 3
                            ]
                        ]
                    ],
                    [
                        'title' => '角色管理',
                        'name' => 'Role',
                        'children' => [
                            [
                                'title'=>'角色列表',
                                'name' => 'List',
                                'level' => 3,
                                'children' => [
                                    ['title' => '新增角色','name' =>'add','level' => 4],
                                    ['title' => '删除角色','name' =>'delete','level' => 4],
                                    ['title' => '编辑角色','name' =>'edit','level' => 4],
                                ]
                            ],
                            [
                                'title' => '编辑角色',
                                'name' => 'Edit',
                                'level' => 3,
                            ],
                            [
                                'title' => '新增角色',
                                'name' => 'Add',
                                'level' => 3,
                            ],
                            [
                                'title' => '删除角色',
                                'name' => 'DELETE',
                                'level' => 3
                            ]
                        ]
                    ],
                    [
                        'title' => '权限管理',
                        'name' => 'Access',
                        'level' => 2,
                        'children' => [
                            [
                                'title'=>'权限列表',
                                'name' => 'List',
                                'level' => 3,
                                'children' => [
                                    ['title' => '新增权限','name' =>'add','level' => 4],
                                    ['title' => '删除权限','name' =>'delete','level' => 4],
                                    ['title' => '编辑权限','name' =>'edit','level' => 4],
                                ]
                            ],
                            [
                                'title' => '编辑权限',
                                'name' => 'Edit',
                                'level' => 3
                            ],
                            [
                                'title' => '新增权限',
                                'name' => 'Add',
                                'level' => 3
                            ],
                            [
                                'title' => '删除权限',
                                'name' => 'DELETE',
                                'level' => 3
                            ]
                        ]
                    ]                    
                ]
            ]
        ];
        $this->do($data);
    }

    public function do(&$data,$pid=0){
        foreach($data as $k =>$v){
            if(isset($v['children'])){
                $children = $v['children'];
                unset($v['children']);
                $v['pid'] = $pid;
                $access = Yjtec\Rbac\Models\Access::create($v);
                $data = $children;
                //$access->child()->createMany($children);
                $this->do($data,$access->id);
            }else{
                $v['pid'] = $pid;
                $access = Yjtec\Rbac\Models\Access::create($v);
            }
        }
        
    }
}
