<?php

namespace Yjtec\Rbac\Resources;

use Illuminate\Http\Resources\Json\Resource;

class LoginUser extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this->roles);
        return [
            'name' => $this->nick_name ? $this->nick_name : $this->account ? $this->account : '游客',
            'avatar' => $this->avatar_url
        ];
    }

    public function with($request){
        return [
            'errcode' => 0,
            'errmsg' => '获取成功'
        ];
    }
}
