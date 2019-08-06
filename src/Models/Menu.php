<?php

namespace Yjtec\Rbac\Models;

class Menu extends Model
{
    protected $fillable = ['id', 'name', 'title', 'path', 'icon', 'pid', 'access_id', 'is_show', 'is_show_children'];
    public function roles()
    {
        return $this->belongsToMany('Yjtec\Rbac\Models\Role', 'menu_role');
    }
}
