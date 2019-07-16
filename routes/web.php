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

Route::get('/', 'Home\IndexController@index');
Route::get('/HT', 'Admin\LoginController@index');
Route::get('home/index/mcnList','Home\IndexController@mcnList');
Route::resource('admin/admin', 'Admin\AdminController');
Route::resource('admin/menu', 'Admin\MenuController');
Route::resource('admin/role', 'Admin\RoleController');
Route::resource('admin/center', 'Admin\CenterController');
Route::resource('admin/user', 'Admin\UserController');
Route::any('admin/role/role/{id}', 'Admin\RoleController@role');
Route::any('admin/role/auth', 'Admin\RoleController@auth');
Route::any('admin/admin/role/{id}', 'Admin\AdminController@role');
Route::any('admin/login/login', 'Admin\LoginController@login');
Route::any('admin/login/logout', 'Admin\LoginController@logout');
