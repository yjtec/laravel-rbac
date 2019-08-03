<?php 
namespace Yjtec\Rbac\Controllers;
use Illuminate\Http\Request;
use Yjtec\Rbac\Requests\User\LoginRequest;
use Yjtec\Rbac\Resources\LoginResource;
class LoginController extends Controller{

    /**
     * @OA\Post(
     *     path="/login",
     *     description="管理员登陆",
     *     tags={"Login"},
     *     summary="管理员登陆",
     *     operationId="ApiUserLogin",
     *     @OA\Response(
     *         response="200",
     *         description="登陆成功",
     *         
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/LoginUser"),
     *     security={
     *         {"token":{}}
     *     }
     * )
     */    
    public function index(LoginRequest $request){
        $user = $request->input('user');


        $token = str_random(60);
        $user->api_token = $token;
        $user->save();
        return new LoginResource($user);
        //dd($user->roles->pluck('name'));
        
    }
}
?>