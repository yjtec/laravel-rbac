<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rbac')->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account')->unique()->comment('账号');
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('nick_name')->comment("昵称");
            $table->string('email')->unique()->comment('邮箱');
            $table->string('salt')->comment('盐池');
            $table->string('password')->comment('密码');
            $table->tinyInteger('status')->default(1)->comment('状态:1启用 -1禁用');
            $table->string('api_token','60')->nullable()->comment('api_token');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('rbac')->dropIfExists('users');
    }
}
