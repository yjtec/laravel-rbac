<?php

namespace Yjtec\Rbac\Models;
use Yjtec\Support\Nested;
use Yjtec\Rbac\Models\Menu;
class Role extends Model
{
    protected $fillable = ['title', 'name','pid','remark'];
    public function users(){
        return $this->belongsToMany('Yjtec\Rbac\Models\User','user_role');
    }

    public function accesses(){
        return $this->belongsToMany('Yjtec\Rbac\Models\Access','role_access');
    }

    public function menus(){
        return $this->belongsToMany('Yjtec\Rbac\Models\Menu','menu_role');
    }

    public function getSideMenuAttribute(){
        $re = [];
        if($this->menus->isNotEmpty()){
            $nestedMenu = Menu::get()->toArray();
            foreach($this->menus as $menu){
                $parents = Nested::getParents($nestedMenu,$menu->id);
                $children = Nested::getChildren($nestedMenu,$menu->id);
                $re = array_merge($re,$parents,$children);
            }
            $re = collect($re)->unique('id')->toArray();
        }
        return $re;
    }



}
