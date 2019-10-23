<?php
namespace Yjtec\Rbac\Repositories\Eloquent;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    protected $app; //App容器
    protected $model; //操作的model
    public $ErrorCode; //错误码
    public $ErrorMsg; //错误信息
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract public function model();

    public function findBy($id)
    {
        return $this->model->find($id);
    }

    public function makeModel()
    {
        $model = $this->app->make($this->model());
        /*是否是Model实例*/
        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        $model->setConnection(config('rbac.connection'));
        $this->model = $model;
    }
    public function index($where)
    {
        return $this->model->where($where)->first();
    }
    public function update($where, $data)
    {
        return $this->model->where($where)->update($data);
    }
    public function page($page)
    {
        return $this->model->paginate($page);
    }

    public function list($where){
        return $this->model->where($where)->get();
    }
    public function add($data)
    {
        //dd($this->model instanceof \Yjtec\Rbac\Models\User);
        return $this->model->create($data);
    }

    public function findByField($field, $value)
    {
        return $this->model->where($field, $value)->first();
    }
}
