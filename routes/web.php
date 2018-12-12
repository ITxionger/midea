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
	Route::resource('/admin/orders','Admin\OrdersController'); //后台订单模块
	Route::resource('/admin/ordersmemo','Admin\OrdersController@memo');  //修改商家备注方法
	Route::resource('/admin/ordersaddr','Admin\OrdersController@addr');  //修改发货信息方法
	Route::get('/admin/ordersprice','Admin\OrdersController@editprice');   //修改订单商品单价
	Route::get('/admin/ordersexpress','Admin\OrdersController@express');  //设置发货
	Route::get('/admin/orderslogistics','Admin\OrdersController@showlogistics');   //获取物流信息
});
