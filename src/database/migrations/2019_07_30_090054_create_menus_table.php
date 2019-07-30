<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('菜单名称');
            $table->string('name')->comment('菜单名称');
            $table->string('icon')->comment('菜单图标');
            $table->string('path')->comment('菜单路径');
            $table->string('access_id')->comment('权限ID');
            $table->integer('pid')->default(0)->comment('菜单等级 0 顶级 默认');
            $table->tinyInteger('is_show')->default(1)->comment('菜单是否显示：１显示默认 0 不显示');
            $table->tinyInteger('is_show_children')->default(1)->comment('子菜单是否显示：１显示默认 0 不显示');
            $table->comment = '菜单表';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}