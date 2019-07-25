<?php

namespace Yjtec\Rbac\Controllers;

use Yjtec\Rbac\Requests\Access\StoreRequest;
use Yjtec\Rbac\Requests\Access\DestoryRequest;
use Yjtec\Rbac\Requests\Access\UpdateRequest;
use Yjtec\Rbac\Repositories\Contracts\AccessInterface;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    private $repo;
    public function __construct(AccessInterface $repo)
    {
        $this->repo = $repo;
    }
    /**
     * @OA\Get(
     *     path="/access",
     *     description="权限列表",
     *     tags={"Access"},
     *     summary="权限列表",
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
     *         description="权限列表"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $type = \Request::input('type');
        $data = $this->repo->list(['app_id'=>\Request::input('app_id')]);
        if($type == 'nested'){
            return \Yjtec\Support\Nested::unlimitedForlayer($data->toArray(),'children');
        }        
        return $data;
    }

    /**
     * @OA\Post(
     *     path="/access",
     *     description="新增权限",
     *     tags={"Access"},
     *     summary="新增权限",
     *     operationId="ApiAccessStore",
     *     @OA\Response(
     *         response="200",
     *         description="新增成功",
     *
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/StoreAccess"),
     *     security={
     *         {"appid":{}}
     *     }
     * )
     */
    public function store(StoreRequest $request)
    {
        return $this->repo->add($request->only(['title', 'name', 'pid', 'app_id','level']));
    }
    /**
     * @OA\Get(
     *     path="/access/{id}",
     *     description="获取一个权限",
     *     tags={"Access"},
     *     summary="获取一个权限",
     *     operationId="ApiAccessShow",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *         response="200",
     *         description="获取成功",
     *     )
     * )
     */        
    public function show($access){
        return $access;
    }

    /**
     * @OA\Put(
     *     path="/access/{id}",
     *     description="修改权限(字段存在即修改，不存在不修改)",
     *     tags={"Access"},
     *     summary="修改权限",
     *     operationId="ApiAccessUpdate",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\RequestBody(ref="#/components/requestBodies/UpdateAccess"),
     *     @OA\Response(
     *         response="200",
     *         description="新增成功",
     *     )
     * )
     */        
    public function update($access ,UpdateRequest $request){
        $data = $request->only(['title','name','pid','level']);
        foreach($data as $k=>$v){
            $access->$k = $v;
        }
        $access->save() ? tne('SUCCESS') : tne("FAIL");
    }
    /**
     * @OA\Delete(
     *     path="/access/{id}",
     *     description="删除权限",
     *     tags={"Access"},
     *     summary="删除权限",
     *     operationId="ApiAccessDelete",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *         response="200",
     *         description="删除成功",
     *     )
     * )
     */
    public function destory($access,DestoryRequest $request)
    {   
        $access->delete() ? tne('SUCCESS') : tne('FAIL');
    }
}
