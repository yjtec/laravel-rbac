<?php

namespace Yjtec\Rbac\Controllers;

use Yjtec\Rbac\Requests\Role\StoreRequest;
use Yjtec\Rbac\Requests\Role\UpdateRequest;
use Yjtec\Rbac\Requests\Role\DestoryRequest;
use Yjtec\Rbac\Repositories\Contracts\RoleInterface;
class RoleController extends Controller
{
    private $roleRepo;
    public function __construct(RoleInterface $roleRepo){
        $this->roleRepo = $roleRepo;
    }
    /**
     * @OA\Get(
     *     path="/role",
     *     description="角色列表",
     *     tags={"Role"},
     *     summary="角色列表",
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="数据类型 normal 一维 nested 无限级",
     *         required=true,
     *         @OA\Schema(
     *           type="array",
     *           default="normal",
     *           @OA\Items(
     *               type="string",
     *               enum={"normal","nested"}
     *           ),
     *         ),
     *         style="form"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="角色列表"
     *     )
     * )
     */
    public function role(){
        $type = \Request::input('type');
        $data = $this->roleRepo->list([]);
        if($type == 'nested'){
            return \Yjtec\Support\Nested::unlimitedForlayer($data->toArray(),'children');
        }

        return $data;
    }

    /**
     * @OA\Get(
     *     path="/role/{id}",
     *     description="获取单个角色",
     *     tags={"Role"},
     *     summary="获取单个角色",
     *     operationId="ApiRoleShow",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *         response="200",
     *         description="获取成功",
     *     )
     * )
     */
    public function show($role){
        $role->accesses = $role->accesses;
        return $role;
    }
    /**
     * @OA\Post(
     *     path="/role",
     *     description="新增角色",
     *     tags={"Role"},
     *     summary="新增角色",
     *     operationId="ApiRoleStore",
     *     @OA\Response(
     *         response="200",
     *         description="新增成功",
     *         
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/StoreRole"),
     *     security={
     *         {"appid":{}}
     *     }
     * )
     */
    public function store(StoreRequest $request){
        $data = $request->only(['title','name','pid','app_id','remark']);
        tne('SUCCESS');
        //return $this->roleRepo->add($data);
    }

    public function update($role,UpdateRequest $request){
        $data = $request->only(['title','pid','remark']);
        foreach($data as $k => $v){
            $role->$k = $v;
        }
        return $role->save() ? tne('SUCCESS') : tne('FAIL');
    }
    /**
     * @OA\Delete(
     *     path="/role/{id}",
     *     description="删除角色",
     *     tags={"Role"},
     *     summary="删除角色",
     *     operationId="ApiRoleDelete",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *         response="200",
     *         description="新增成功",
     *     )
     * )
     */    
    public function destory($role,DestoryRequest $request){
        $role->delete() ? tne('SUCCESS') : tne('FAIL');
    }
    /**
     * @OA\Put(
     *     path="/role/{id}/access",
     *     description="角色赋权限",
     *     tags={"Role"},
     *     summary="角色赋权限",
     *     operationId="ApiRoleAccess",
     *     @OA\Parameter(
     *         name="access[]",
     *         in="query",
     *         description="权限的ID",
     *         required=true,
     *         @OA\Schema(
     *           type="array",
     *           @OA\Items(type="string"),
     *         ),
     *         style="form"
     *     ),
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *         response="200",
     *         description="新增成功",
     *     )
     * )
     */        
    public function access($role){
        $access = \Request::input('access');
        //dd($role->accesses);
        $role->accesses()->sync($access) ? tne('SUCCESS') : tne("FAIL");
    }

    /**
     * @OA\Get(
     *     path="/role/access/{id}",
     *     description="获取角色的权限",
     *     tags={"Role"},
     *     summary="获取角色的权限",
     *     operationId="ApiRoleAccessGet",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *         response="200",
     *         description="新增成功",
     *     )
     * )
     */        
    public function roleAccess($role){
        return $role->accesses;
    }
}
