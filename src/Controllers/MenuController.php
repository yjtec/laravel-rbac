<?php

namespace Yjtec\Rbac\Controllers;

use Yjtec\Rbac\Requests\Menu\StoreRequest;
use Yjtec\Rbac\Requests\Menu\DestoryRequest;
use Yjtec\Rbac\Requests\Menu\UpdateRequest;
use Yjtec\Rbac\Repositories\Contracts\MenuInterface;
use Illuminate\Http\Request;
use Yjtec\Rbac\Resources\Route as RouteResource;

class MenuController extends Controller
{
    private $repo;
    public function __construct(MenuInterface $repo){
        $this->repo  = $repo;
    }
    /**
     * @OA\Get(
     *     path="/menu",
     *     description="菜单列表",
     *     tags={"Menu"},
     *     summary="菜单列表",
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
     *         description="菜单列表"
     *     )
     * )
     */    
    public function index(Request $reuqest){
        $type = $reuqest->input('type');
        $data = $this->repo->list([]);        
        if($type == 'nested'){
            return \Yjtec\Support\Nested::unlimitedForlayer($data->toArray(),'children');
        }        
        return $data;
    }

    /**
     * @OA\Post(
     *     path="/menu",
     *     description="新增菜单",
     *     tags={"Menu"},
     *     summary="新增菜单",
     *     operationId="ApiMenuStore",
     *     @OA\Parameter(
     *         name="roles[]",
     *         in="query",
     *         description="选择的角色ID",
     *         @OA\Schema(
     *           type="array",
     *           @OA\Items(type="string"),
     *         ),
     *         style="form"
     *     ),
     *     @OA\Parameter(
     *         name="accesses[]",
     *         in="query",
     *         description="权限ID",
     *         @OA\Schema(
     *           type="array",
     *           @OA\Items(type="string"),
     *         ),
     *         style="form"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="新增成功",
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/StoreMenu"),
     *     security={
     *         {"appid":{}}
     *     }
     * )
     */
    public function store(StoreRequest $request){
        $data = $request->only(['title','name','pid','icon','path','is_show','is_show_children','access_id']);
        $menu = $this->repo->add($data);
        $menu->roles()->attach($request->input('roles'));
        $menu->accesses()->attach($request->input('accesses'));
        return $menu;
    }

    /**
     * @OA\Put(
     *     path="/menu/{id}",
     *     description="修改菜单(字段存在即修改，不存在不修改)",
     *     tags={"Menu"},
     *     summary="修改菜单",
     *     operationId="ApiMenuUpdate",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Parameter(
     *         name="roles[]",
     *         in="query",
     *         description="选择的角色ID",
     *         @OA\Schema(
     *           type="array",
     *           @OA\Items(type="string"),
     *         ),
     *         style="form"
     *     ),
     *     @OA\Parameter(
     *         name="accesses[]",
     *         in="query",
     *         description="权限ID",
     *         @OA\Schema(
     *           type="array",
     *           @OA\Items(type="string"),
     *         ),
     *         style="form"
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/StoreMenu"),
     *     @OA\Response(
     *         response="200",
     *         description="修改菜单",
     *     )
     * )
     */        
    public function update($menu ,UpdateRequest $request){
        $data = $request->only(['title','name','pid','icon','path','is_show','is_show_children','access_id']);
        foreach($data as $k=>$v){
            $menu->$k = $v;
        }
        if($request->has('roles')){
            $roles = $request->input('roles');
            $menu->roles()->sync($roles);
        }else{
            $menu->roles()->detach();
        }
        if($request->has('accesses')){
            $accesses = $request->input('accesses');
            $menu->accesses()->sync($accesses);
        }else{
            $menu->accesses()->detach();
        }

        $menu->save() ? tne('SUCCESS') : tne("FAIL");
    }
    /**
     * @OA\Get(
     *     path="/menu/{id}",
     *     description="获取一个菜单",
     *     tags={"Menu"},
     *     summary="获取一个菜单",
     *     operationId="ApiMenuShow",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *         response="200",
     *         description="获取成功",
     *     )
     * )
     */
    public function show($menu){
        $menu->roles_ids = $menu->roles->pluck('id');
        $menu->accesses_ids = $menu->accesses->pluck('id');
        return $menu;
    }
    /**
     * @OA\Delete(
     *     path="/menu/{id}",
     *     description="删除菜单",
     *     tags={"Menu"},
     *     summary="删除菜单",
     *     operationId="ApiMenuDelete",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *         response="200",
     *         description="删除成功",
     *     )
     * )
     */    
    public function destory($menu,DestoryRequest $request){
        $menu->delete() ? tne('SUCCESS') : tne('FAIL');
    }
    /**
     * @OA\Delete(
     *     path="/menu/",
     *     description="批量删除菜单",
     *     tags={"Menu"},
     *     summary="删除菜单",
     *     operationId="ApiMenuMulDelete",
     *     @OA\Parameter(
     *         name="ids[]",
     *         in="query",
     *         description="选择IDs",
     *         required=true,
     *         @OA\Schema(
     *           type="array",
     *           @OA\Items(type="string"),
     *         ),
     *         style="form"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="删除成功",
     *     )
     * )
     */
    public function mulDestory(Request $request){
        $ids = $request->input('ids');
        $this->repo->mulDelete($ids) ? tne('SUCCESS') : tne("FAIL");
    }

    /**
     * @OA\Get(
     *     path="/routes/",
     *     description="前端获取菜单",
     *     tags={"Menu"},
     *     summary="前端获取菜单",
     *     operationId="ApiRoutes",
     *     @OA\Response(
     *         response="200",
     *         description="获取成功",
     *     )
     * )
     */    
    public function routes(Request $request){
        //$type = $request->input('type');
        $data = $this->repo->list([]);
        return RouteResource::collection($data);
    }
}