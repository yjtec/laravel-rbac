<?php

namespace Yjtec\Rbac\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['title', 'pid','remark'];
    public function users(){
        return $this->belongsToMany('App\Models\User','user_role');
    }

    public function accesses(){
        return $this->belongsToMany('Yjtec\Rbac\Models\Access','role_access');
    }

}
