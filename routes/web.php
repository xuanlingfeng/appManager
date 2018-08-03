<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', function () {
    return redirect('/admin');
});
Route::group(['middleware'=>'auth','prefix'=>'admin'],function(){

    Route::get('/', 'Admin\IndexController@index'); // 返回后台视图
    Route::resource('/user', 'Admin\UserController');  // 用户资源管理
    Route::get('/user/del/{id}', 'Admin\UserController@destroy');  //删除用户
    Route::post('/xiugai/changePassword', 'Admin\UserController@changePassword');  // 修改密码
    Route::resource('/permission', 'Admin\PermissionController');  // 设置权限管理
    
    Route::resource('/role', 'Admin\RoleController');  // 角色管理

    Route::resource('/city', 'Admin\CityController');  // 城市管理
    Route::get('/city/del/{id}', 'Admin\CityController@destroy');  //删除校区
  
    Route::resource('/campus', 'Admin\CampusController');  // 校区管理
    Route::get('/campus/del/{id}', 'Admin\CampusController@destroy');  //删除校区

    Route::resource('/project', 'Admin\ProjectController');  // 项目管理
    Route::get('/project/add/{id}', 'Admin\ProjectController@add');  //项目管理---添加
    Route::get('/project/del/{id}', 'Admin\ProjectController@destroy');  //删除项目


    Route::resource('/actClass', 'Admin\ActClassController');  //活动类型管理
    Route::get('/actClass/del/{id}', 'Admin\ActClassController@destroy');  //删除活动类型

    Route::resource('/act', 'Admin\ActController');  //活动管理
    Route::get('/act/del/{id}', 'Admin\ActController@destroy');  //删除活动

   
});
