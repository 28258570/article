<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    //
    protected $table = 'admin';

    /**
     * 获取角色名称
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getRole()
    {
        return $this->hasOne('App\Models\AdminRole','admin_id','id');
    }

    /**
     * 添加管理员
     * @param $params
     * @return bool
     */
    public static function AddData($params)
    {
        $model = new self();
        $model->username = $params['username'];
        $model->password = bcrypt($params['password']);
        return $model->save();
    }

    /**
     * 管理员列表
     * @param $params
     * @param int $page
     * @return Admin|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getData($params,$page=15)
    {
        $list = new self();

        $list = $list->orderBy('id', 'desc')->paginate($page);
        return $list;
    }
}
