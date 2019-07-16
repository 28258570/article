<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table = 'menu';

    public static function getData($params,$page=15)
    {
        $list = (new self());

        if(!empty($params['menu_name'])){
            $list = $list->where('menu_name','like',$params['menu_name']);
        }

        $list = $list->orderBy('id', 'asc')->paginate($page);
        return $list;
    }

    /**
     * 当前登录用户所拥有的权限菜单
     * @return \Illuminate\Support\Collection
     */
    public static function getMenu()
    {
        $admin_id = session('admin_id');
        $role = (new AdminRole())->where('admin_id','=',$admin_id)->first();
        $menu_id = explode(',',$role->getRole->menu_ids);
        $menu = (new Menu())->whereIn('id',$menu_id)->get();
        return $menu;
    }
}
