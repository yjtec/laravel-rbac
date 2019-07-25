<?php
namespace Yjtec\Rbac\Repositories\Eloquent;

use Yjtec\Rbac\Models\Access;
use Yjtec\Rbac\Repositories\Contracts\AccessInterface;
use Yjtec\Repo\Repository;
class AccessRepository extends Repository implements AccessInterface
{
    
    /**
     * Specify Model class name
     * 
     * @return string
     */
    public function model()
    {
        // TODO: Implement model() method.
        return Access::class;
    }
}