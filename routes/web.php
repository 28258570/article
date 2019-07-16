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
Route::get('home/index/mcnList','Home\IndexController@mcnList');
Route::resource('admin/admin', 'Admin\AdminController');
Route::resource('admin/menu', 'Admin\MenuController');
