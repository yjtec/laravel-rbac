<?php

namespace Yjtec\Rbac\Controllers;
use Illuminate\Http\Request;
use Yjtec\Rbac\Requests\User\StoreRequest;
use Yjtec\Rbac\Requests\User\LoginRequest;
use Yjtec\Rbac\Requests\User\UpdateRequest;
use Yjtec\Rbac\Controllers\Controller;
use Yjtec\Rbac\Repositories\Contracts\UserInterface;
use Illuminate\Support\Facades\Auth;
use Yjtec\Rbac\Resources\LoginUser as LoginUserResource;
use App\Services\UploadService;

class UserController extends Controller
{
    private $uploadService;
    public function __construct(UserInterface $repo){
        $this->repo = $repo;
        $this->uploadService = new UploadService();
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
            $firstSeconds = date('Y-m-d H:i:s',strtotime(date($request->input('stime'))));
            $where[] = ['created_at','>',$firstSeconds];
        }
        if($request->has('etime')){
            $lastSeconds = date('Y-m-d H:i:s',strtotime("+1 days",strtotime($request->input('etime'))));
            $where[] = ['created_at','<=',$lastSeconds];
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
        $data = $request->except(['pwd','roles']);
        $user = $this->repo->add($data);

        $user->api_token = str_random(60);
        $res = $user->save();
        $user->roles()->attach($request->input('roles'));
        $res ? tne('SUCCESS') : tne('FAIL');
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
        $data = $request->only(['email','nick_name','avatar','password','salt']);
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

    /**
     * @OA\get(
     *     path="/user/change/{id}",
     *     description="管理员状态",
     *     tags={"User"},
     *     summary="管理员状态",
     *     operationId="ApiUserDelete",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *         response="200",
     *         description="禁用/开启成功",
     *     )
     * )
     */
    public function changeStatus($user,UpdateRequest $request){
        if(!$request->filled('status')){
            tne('STATUS_NOT_NULL');
        }
        $status = $request->get('status');
        $user->status = $status;
        $user->save() ? tne('SUCCESS') : tne('FAIL');
    }

    public function mul(Request $request){
        $type = $request->type;
        $keys = $request->key;
        $this->repo->$type(explode(',', $keys)) ? tne("SUCCESS") : tne("FAIL");
    }

    public function loginUser(){
        return new LoginUserResource(Auth::guard('rbac')->user());
    }
}
