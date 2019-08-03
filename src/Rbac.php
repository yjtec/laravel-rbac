<?php 
namespace Yjtec\Rbac;
class Rbac{

    public function menu($userId){
        $roles = \Yjtec\Rbac\Models\Role::whereHas('users',function($q) use ($userId){
            $q->where('user_id',$userId);
        })->get();
        if(!$roles){
            return [];
        }

        $roleIds = $roles->pluck('id')->toArray();

        $accesses = \Yjtec\Rbac\Models\Access::whereHas('roles',function($q) use ($roleIds){
            $q->whereIn('role_id',$roleIds);
        })->get();

        $menu = [];
        foreach($accesses as $access){
            if($m = $access->menu){
                $menu[] = $m->toArray();
            }
        }

        return[
            'menu'=> $menu,
            'access' => $accesses
        ];

        //return $accesses->toArray();
        
    }
}
?>