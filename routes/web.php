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

Route::get('/', function () {
    return view('welcome');
});
//后台登录页面
Route::resource('/adminlogin','Admin\LoginController');
//后台路由
Route::group(['middleware'=>'login'],function(){
	Route::get('/admin',function(){
		return view('Admin.index');
	});//后台首页
	Route::resource('/adminuser','Admin\AdminuserController');	//后台管理员模板管理
	Route::resource('/homeuser','Admin\UserController');		//前台用户管理
});