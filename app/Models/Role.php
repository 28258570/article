<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'role';

    /**
     * 添加角色
     * @param $params
     * @return bool
     */
    public static function addData($params)
    {
        $model = (new self());
        $model->name = $params['name'];
        $model->description = $params['description'];
        return $model->save();
    }

    /**
     * 获取角色列表
     * @param int $page
     * @return Role|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getData($page=15)
    {
        $list = new self();

        $list = $list->orderBy('id', 'asc')->paginate($page);
        return $list;
    }

    /**
     * 设置菜单表ID
     * @param $params
     * @return bool
     */
    public static function addMenuIds($params)
    {
        $role = (new self())->find($params['id']);
        $role->menu_ids = $params['menu'];
        return $role->save();
    }

}
