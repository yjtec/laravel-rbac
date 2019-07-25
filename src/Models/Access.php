<?php

namespace Yjtec\Rbac\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    //
    protected $fillable=['title','name','pid','app_id','level'];

    public function child(){
        return $this->hasMany($this,'pid');
    }

    public function roles(){
        return $this->belongsToMany('App\Models\Role','role_access');
    }

}
