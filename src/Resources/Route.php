<?php

namespace Yjtec\Rbac\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Route extends Resource
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
            'path' => $this->path,
            'icon' => $this->icon,
            'name' => $this->title,
            'pid' => $this->pid,
            'authority' => $this->roles->pluck('name')
        ];
    }

    public function with($request){
        return [
            'errcode' => 0,
            'errmsg' => '登陆成功'
        ];
    }
}
