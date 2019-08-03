<?php

namespace Yjtec\Rbac\Resources;

use Illuminate\Http\Resources\Json\Resource;

class LoginResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'token' => $this->api_token,
            'currentAuthority' => $this->roles->pluck('name'),
            'type' => $request->has('type') ? $request->input('type') :'account'
        ];
    }

    public function with($request){
        return [
            'errcode' => 0,
            'errmsg' => '登陆成功'
        ];
    }
}
