<?php
namespace Yjtec\Rbac\Repositories\Eloquent;

use Yjtec\Rbac\Models\User;
use Yjtec\Rbac\Repositories\Contracts\UserInterface;
use Yjtec\Repo\Repository;
use DB;
class UserRepository extends Repository implements UserInterface
{
    
    /**
     * Specify Model class name
     * 
     * @return string
     */
    public function model()
    {
        // TODO: Implement model() method.
        return User::class;
    }

    public function getPwd($account,$pwd){
        return $this->model
                ->select(DB::raw("md5(concat('$pwd',salt)) as pwd"))
                ->where('account',$account)
                //->where('password','=',DB::raw("md5(concat('$pwd'),salt)"))
                ->get()->toArray();
    }

    public function list($where,$page = false,$width = false){
        $q = $this->model
            ->where($where)
            ->orderBy('id','desc')
            ->when($width,function($query) use($width) {
                return $query->whereHas('roles',function($q) use($width){
                    $q->whereIn('id',$width);
                });
            })
            ->with('roles');
        return $page ?  $q->paginate($page) : $q->get();
    }

    public function disable($keys){
        return $this->model->whereIn('id',$keys)->update(['status'=>'-1']);
    }

    public function enable($keys){
        return $this->model->whereIn('id',$keys)->update(['status'=>'1']);
    }
}