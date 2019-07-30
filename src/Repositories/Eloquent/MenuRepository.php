<?php
namespace Yjtec\Rbac\Repositories\Eloquent;

use Yjtec\Rbac\Models\Menu;
use Yjtec\Rbac\Repositories\Contracts\MenuInterface;
use Yjtec\Repo\Repository;
class MenuRepository extends Repository implements MenuInterface
{
    
    /**
     * Specify Model class name
     * 
     * @return string
     */
    public function model()
    {
        // TODO: Implement model() method.
        return Menu::class;
    }
}