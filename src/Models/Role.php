<?php

namespace Yjtec\Rbac\Models;

class Role extends Model
{
    protected $fillable = ['title', 'name','pid','remark'];
    public function users(){
        return $this->belongsToMany('Yjtec\Rbac\Models\User','user_role');
    }

    public function accesses(){
        return $this->belongsToMany('Yjtec\Rbac\Models\Access','role_access');
    }

}
