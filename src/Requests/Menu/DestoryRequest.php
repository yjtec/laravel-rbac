<?php

namespace Yjtec\Rbac\Requests\Menu;
use Illuminate\Validation\Rule;
class DestoryRequest extends Request
{
    public function rules(){
        return [];
    }
    public function withValidator($validator)
    {
        // $validator->after(function($validator){
        //     $access = $this->route('access');
        //     if($access->child->isNotEmpty()){
        //         $validator->errors()->add('id','请先删除此分类下的子类');
        //     }
        //     if($access->roles->isNotEmpty()){
        //         $validator->errors()->add('id','此权限已经绑定到角色，不可删除');
        //     }
        // });
    }
}
