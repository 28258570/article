<?php
use Illuminate\Http\Request;
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
//Route::get('HT', 'Admin\LoginController@login');
Route::any('{dir}/{controller}/{action}', function (Request $request,$dir,$controller,$action) {
    $class = App::make("\\App\\Http\\Controllers\\$dir\\$controller");

    $kernel = App::make("\\App\\Http\\Kernel");
    $routeMiddleware = $kernel->getRouteMiddleware();
    $pipe = [];
    foreach($class->getMiddleware() as $middle) {
        if(isset($middle['options']['except']) && in_array($action, $middle['options']['except'])) {
            continue;
        }
        $pipe[] = $routeMiddleware[$middle['middleware']];
    }
    $distination = function() use ($class,$action,$request) {
        return $class->callAction($action,[$request]);
    };
    $pipe = array_reverse($pipe);
    $callback = array_reduce($pipe,getCustomSlice(),$distination);

    return call_user_func($callback,$request);
});