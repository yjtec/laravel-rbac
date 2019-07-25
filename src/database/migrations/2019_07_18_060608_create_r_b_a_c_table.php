<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRBACTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //角色表
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('角色名称');
            $table->string('remark')->comment('描述');
            $table->tinyInteger('pid')->default(0)->comment('父级ID 默认为0');
            $table->softDeletes();
            $table->timestamps();
            $table->comment = "角色表";
        });
        //用户角色中间表
        Schema::create('user_role', function (Blueprint $table) {
            $table->integer('user_id')->comment('用户ID');
            $table->integer('role_id')->comment('角色ID');
            $table->comment = '用户角色表';
        });

        //权限表
        Schema::create('accesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('权限名称');
            $table->string('name')->comment('权限英文名称');
            $table->tinyInteger('pid')->default(0)->comment('父级ID 默认为0');
            $table->tinyInteger('level')->default(1)->comment('权限等级:1 app 2 module 3 method 4 action');
            $table->softDeletes();
            $table->timestamps();
            $table->comment = '权限表';
        });

        //角色权限中间表
        Schema::create('role_access', function (Blueprint $table) {
            $table->integer('role_id')->comment('用户ID');
            $table->integer('access_id')->comment('角色ID');
            $table->comment = '角色权限表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('accesses');
        Schema::dropIfExists('user_role');
        Schema::dropIfExists('role_access');
        //Schema::dropIfExists('accesses');
    }
}
