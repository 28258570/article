<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Menu;
use Closure;

class checkLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->checkAuthAndLogin($request)){
            return $next($request);
        } else {
            return redirect('/HT');
        }
    }

    /**
     * 判断是否登录以及访问
     * @param $request
     * @return bool
     */
    protected function checkAuthAndLogin($request)
    {
        if ($request->session()->has('admin_id')){
            $menu_url = Menu::getMenu();
            $url = [];
            foreach ($menu_url as $k=>$v){
                $url[$k] = $v->menu_url;
            }
            if (in_array('/'.$request->path(),$url)){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
