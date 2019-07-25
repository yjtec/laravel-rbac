<?php
namespace Yjtec\Rbac\Repositories\Eloquent;

use Yjtec\Rbac\Models\Role;
use Yjtec\Rbac\Repositories\Contracts\RoleInterface;
use Yjtec\Repo\Repository;
class RoleRepository extends Repository implements RoleInterface
{
    
    /**
     * Specify Model class name
     * 
     * @return string
     */
    public function model()
    {
        // TODO: Implement model() method.
        return Role::class;
    }

    // public function list($where){
    //     return $this->model->where($where)->get();
    // }
}