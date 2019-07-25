<?php 
Route::get('/role','RoleController@role'); //角色列表
Route::post('/role','RoleController@store'); //新增角色
Route::get('/role/{role}','RoleController@show');//获取当前角色
Route::put('/role/{role}','RoleController@update'); //修改角色
Route::delete('/role/{role}','RoleController@destory'); //删除角色
Route::put('/role/{role}/access','RoleController@access');//角色分配权限
Route::get('/role/access/{role}','RoleController@roleAccess');//获取角色的权限
Route::get('/access','AccessController@index'); //权限列表
Route::post('/access','AccessController@store'); //新增权限
Route::get('/access/{access}','RoleController@show');//获取当前角色
Route::put('/access/{access}','AccessController@update'); //修改权限
Route::delete('/access/{access}','AccessController@destory'); //删除权限
?>