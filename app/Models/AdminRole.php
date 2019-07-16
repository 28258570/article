<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    //
    protected $table = 'admin_role';

    public function getRole(){
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    /**
     * 设置角色
     * @param $params
     * @return bool
     */
    public static function setRole($params)
    {
        $role = (new self())->where('admin_id','=',$params['admin_id'])->first();
        if (empty($role)){
            $model = (new self());
            $model->admin_id = $params['admin_id'];
            $model->role_id = $params['role_id'];
            return $model->save();
        } else {
            $role->role_id = $params['role_id'];
            return $role->save();
        }

    }
}
