<?php
Route::middleware(['rbac.token'])->group(function () {
    Route::get('/role', 'RoleController@role'); //角色列表
    Route::post('/role', 'RoleController@store'); //新增角色
    Route::get('/role/{role}', 'RoleController@show'); //获取当前角色
    Route::put('/role/{role}', 'RoleController@update'); //修改角色
    Route::delete('/role/{role}', 'RoleController@destory'); //删除角色
    Route::put('/role/{role}/access', 'RoleController@access'); //角色分配权限
    Route::get('/role/access/{role}', 'RoleController@roleAccess'); //获取角色的权限
    Route::get('/access', 'AccessController@index'); //权限列表
    Route::post('/access', 'AccessController@store'); //新增权限
    Route::get('/access/{access}', 'RoleController@show'); //获取当前角色
    Route::put('/access/{access}', 'AccessController@update'); //修改权限
    Route::delete('/access/{access}', 'AccessController@destory'); //删除权限

    Route::get('/menu', 'MenuController@index'); //菜单列表
    Route::post('/menu', 'MenuController@store'); //新增菜单
    Route::get('/menu/{menu}', 'MenuController@show'); //获取当前菜单
    Route::put('/menu/{menu}', 'MenuController@update'); //修改当前菜单
    Route::delete('/menu/{menu}', 'MenuController@destory'); //删除菜单
    Route::delete('/menu/', 'MenuController@mulDestory'); //批量删除菜单
    

    Route::get('/user', 'UserController@list');
    Route::post('/user', 'UserController@store');
    Route::post('/user/mul', 'UserController@mul');
    Route::delete('/user/{user}', 'UserController@delete');
    Route::get('/user/{user}', 'UserController@show');
    Route::put('/user/{user}', 'UserController@update');
    Route::get('/currentUser','UserController@loginUser');
});

Route::post('/login', 'LoginController@index');
Route::get('/routes', 'MenuController@routes'); //获取菜单
