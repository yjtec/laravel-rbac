<?php

namespace Yjtec\Rbac\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    protected $fillable = ['account', 'email', 'password', 'nick_name', 'salt', 'avatar'];
    protected $hidden = ['password','salt','remember_token'];
    protected $appends = ['avatar_url'];
    // public function setAccountAttribute($value)
    // {
    //     $this->attributes['password'] = '123456';
    //     $this->attributes['salt']     = '123456';
    //     $this->attributes['account']  = $value;
    // }
    public function getAvatarUrlAttribute(){
        $avatar = $this->attributes['avatar'];
        return $this->attributes['avatar_url'] = \Storage::url($avatar);
    }

    public function roles(){
        return $this->belongsToMany('Yjtec\Rbac\Models\Role','user_role');
    }
}
