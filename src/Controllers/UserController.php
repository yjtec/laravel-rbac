<?php

namespace Yjtec\Rbac\Controllers;
use Illuminate\Http\Request;
use Yjtec\Rbac\Requests\User\StoreRequest;
use Yjtec\Rbac\Requests\User\LoginRequest;
use Yjtec\Rbac\Requests\User\UpdateRequest;
use Yjtec\Rbac\Controllers\Controller;
use Yjtec\Rbac\Repositories\Contracts\UserInterface;

class UserController extends Controller
{
    public function __construct(UserInterface $repo){
        $this->repo = $repo;
    }
    /**
     * @OA\Get(
     *     path="/user",
     *     description="管理员列表",
     *     tags={"User"},
     *     summary="管理员列表",
     *     @OA\Parameter(ref="#/components/parameters/page"),
     *     @OA\Parameter(ref="#/components/parameters/pageSize"),
     *     @OA\Parameter(
     *         description="账号(like)",
     *         in="query",
     *         name="account",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="昵称(like)",
     *         in="query",
     *         name="nick_name",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="邮箱(like)",
     *         in="query",
     *         name="email",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="开始时间（创建）",
     *         in="query",
     *         name="stime",
     *         example="",
     *         @OA\Schema(
     *             type="datetime"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="结束时间（创建）",
     *         in="query",
     *         name="etime",
     *         example="",
     *         @OA\Schema(
     *             type="datetime"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="roles[]",
     *         in="query",
     *         description="角色ID",
     *         @OA\Schema(
     *           type="array",
     *           @OA\Items(type="string"),
     *         ),
     *         style="form"
     *     ),
     *     operationId="ApiUserList",
     *     @OA\Response(
     *         response="200",
     *         description="新增成功"
     *     )
     * )
     */
    public function list(Request $request){
        $where = [];
        if($request->has('status')){
            $where[] = ['status',$request->input('status')];
        }
        if($request->has('account')){
            $where[] = ['account','like','%'.$request->input('account').'%'];
        }
        if($request->has('nick_name')){
            $where[] = ['nick_name','like','%'.$request->input('nick_name').'%'];
        }
        if($request->has('email')){
            $where[] = ['email','like','%'.$request->input('email').'%'];
        }

        if($request->has('stime')){
            $where[] = ['created_at','>',$request->input('stime')];
        }
        if($request->has('etime')){
            $where[] = ['created_at','<=',$request->input('etime')];
        }
        $with = false;
        if($request->has('roles')){
            $with = $request->input('roles');
            //dd($request->input('roles'));
        }
        $pageSize = $request->has('pageSize') ? $request->input('pageSize') : 10;
        return $this->repo->list($where,$pageSize,$with);
    }
    /**
     * @OA\Post(
     *     path="/user",
     *     description="新增管理员",
     *     tags={"User"},
     *     summary="新增管理员",
     *     operationId="ApiUserAdd",
     *     @OA\Parameter(
     *         name="roles[]",
     *         in="query",
     *         description="选择的角色ID",
     *         required=true,
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
     *     @OA\RequestBody(ref="#/components/requestBodies/StoreUser"),
     *     security={
     *         {"appid":{}}
     *     }
     * )
     */
    public function store(StoreRequest $request){
        $data = $request->except('pwd');
        $user = $this->repo->add($data);

        $token = str_random(60);
        $user->api_token = str_random(60);
        $user->save();
        $user->roles()->attach($request->input('roles'));
        return $user;
    }
    /**
     * @OA\Put(
     *     path="/user/{id}",
     *     description="修改管理员(字段存在即修改，不存在不修改)",
     *     tags={"User"},
     *     summary="修改管理员",
     *     operationId="ApiUserUpdate",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Parameter(
     *         name="roles[]",
     *         in="query",
     *         description="角色ID",
     *         @OA\Schema(
     *           type="array",
     *           @OA\Items(type="string"),
     *         ),
     *         style="form"
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/UpdateUser"),
     *     @OA\Response(
     *         response="200",
     *         description="新增成功",
     *     )
     * )
     */    
    public function update($user,UpdateRequest $request){
        $data = $request->only(['email','nick_name','password','salt']);
        foreach ($data as $k => $v) {
            $user->$k = $v;
        }
        if($request->has('roles')){
            $roles = $request->input('roles');
            $user->roles()->sync($roles);
        }
        $user->save() ? tne('SUCCESS') : tne('FAIL');


    }
    /**
     * @OA\Get(
     *     path="/user/{id}",
     *     description="获取单个管理员",
     *     tags={"User"},
     *     summary="获取单个管理员",
     *     operationId="ApiUserShow",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *         response="200",
     *         description="新增成功",
     *     )
     * )
     */
    public function show($user){
        $user->roles = $user->roles;
        return $user;
    }
    
    /**
     * @OA\Delete(
     *     path="/user/{id}",
     *     description="删除管理员",
     *     tags={"User"},
     *     summary="删除管理员",
     *     operationId="ApiUserDelete",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *         response="200",
     *         description="新增成功",
     *     )
     * )
     */
    public function delete($user){
        $user->delete() ? tne('SUCCESS') : tne('FAIL');
    }

    public function mul(Request $request){
        $type = $request->type;
        $keys = $request->key;
        $this->repo->$type(explode(',', $keys)) ? tne("SUCCESS") : tne("FAIL");
    }
}