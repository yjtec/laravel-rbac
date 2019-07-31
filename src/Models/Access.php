<?php

namespace Yjtec\Rbac\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    //
    protected $fillable=['title','name','pid','level'];

    public function child(){
        return $this->hasMany($this,'pid');
    }

    public function roles(){
        return $this->belongsToMany('Yjtec\Rbac\Models\Role','role_access');
    }


    public function menu(){
        return $this->hasOne('Yjtec\Rbac\Models\Menu');
    }

}
