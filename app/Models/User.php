<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'user';

    /**
     * 用户列表
     * @param $params
     * @param int $page
     * @return $this|User
     */
    public static function getData($params,$page=15)
    {
        $list = (new self());

        if (!empty($params['username'])){
            $list = $list->where('username','=',$params['username']);
        }

        if (!empty($params['mobile'])){
            $list = $list->where('mobile','=',$params['mobile']);
        }

        $list = $list->orderBy('id', 'desc')->paginate($page);
        return $list;
    }
}
