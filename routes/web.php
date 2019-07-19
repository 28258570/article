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

Route::get('/', 'Home\IndexController@index');//首页
Route::get('/HT', 'Admin\LoginController@index');//后台登录首页
Route::get('home/index/mcnList','Home\IndexController@mcnList');//MCN机构列表
Route::get('home/buyDetail/mcnDetail','Home\BuyController@mcnDetail');//商品详情
Route::get('home/index/zimei','Home\IndexController@zimei');//自媒体攻略
Route::get('home/index/xinmei','Home\IndexController@xinmei');//新媒体攻略
Route::get('home/others/feedBack','Home\OthersController@feedBack');//意见反馈
Route::get('home/index/joinIn','Home\IndexController@joinIn');//加盟合作
Route::get('home/index/links','Home\IndexController@links');//友情链接
Route::resource('admin/admin', 'Admin\AdminController');//管理员管理
Route::resource('admin/menu', 'Admin\MenuController');//菜单管理
Route::resource('admin/role', 'Admin\RoleController');//角色管理
Route::resource('admin/center', 'Admin\CenterController');//个人中心
Route::resource('admin/user', 'Admin\UserController');//用户管理
Route::resource('admin/mcn', 'Admin\McnController');//MCN机构管理
Route::resource('admin/mcnMeal', 'Admin\McnMealController');//MCN机构套餐管理
Route::any('admin/role/role/{id}', 'Admin\RoleController@role');//设置权限页面
Route::any('admin/role/auth', 'Admin\RoleController@auth');//设置权限
Route::any('admin/admin/role/{id}', 'Admin\AdminController@role');//设置角色
Route::any('admin/login/login', 'Admin\LoginController@login');//后台登录页面
Route::any('admin/login/logout', 'Admin\LoginController@logout');//后台注销
Route::post('admin/user/order', 'Admin\UserController@order');//获取用户订单
Route::post('admin/mcn/upload', 'Admin\McnController@upload');//文章上传
