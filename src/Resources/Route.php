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
        //dd($this->roles);
        return [
            'path' => $this->path,
            'icon' => $this->icon,
            'name' => $this->title,
            'pid' => $this->pid,
            'hideInMenu' => $this->is_show ? false :true,
            'hideChildrenInMenu' => $this->is_show_children ? false:true,
            'authority' => $this->when($this->roles->isNotEmpty(),$this->roles->pluck('name')),
            'access' => $this->when($this->accesses->isNotEmpty(),$this->accesses->pluck('name'))
        ];
    }

    public function with($request){
        return [
            'errcode' => 0,
            'errmsg' => '登陆成功'
        ];
    }
}
