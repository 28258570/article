<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    //
    protected $table = 'admin';

    /**
     * 添加管理员
     * @param $params
     * @return bool
     */
    public static function AddData($params)
    {
        $model = new self();
        $model->username = $params['username'];
        $model->password = encrypt($params['password']);
        return $model->save();
    }
}
