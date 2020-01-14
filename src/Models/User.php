<?php

namespace Yjtec\Rbac\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    protected $fillable = ['account', 'email', 'password', 'nick_name', 'salt', 'avatar'];
    protected $hidden = ['password','salt','remember_token'];
    protected $appends = ['avatar_url'];
    public function getAvatarUrlAttribute(){
        $avatar = $this->attributes['avatar'];
        if($file = config('rbac.file')){ 
            return $this->attributes['avatar_url'] = $file::url($avatar);
        };
        return $this->attributes['avatar_url'] = \Storage::url($avatar);
    }

    public function roles(){
        return $this->belongsToMany('Yjtec\Rbac\Models\Role','user_role');
    }

    public function getSidemenuAttribute(){
        $re = [];
        foreach($this->roles as $role){
            $re = array_merge($re,$role->side_menu);
        }
        return collect($re)->unique('id')->toArray();
    }
}
