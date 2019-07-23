<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mcn extends Model
{
    //
    protected $table = 'mcn';

    /**
     * 添加MCN机构
     * @param $params
     * @return bool
     */
    public static function addData($params)
    {
        $model = (new self());
        $model->name = $params['name'];
        $model->cover = $params['cover'];
        $model->introduce = $params['introduce'];
        $model->price = $params['price'];
        $model->content = $params['content'];
//        $model->picture = $params['picture'];
        $model->state = 1;
        return $model->save();
    }

    /**
     * MCN机构列表
     * @param $oarams
     * @param int $page
     * @return Mcn|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getData($oarams,$page=10)
    {
        $list = new self();

        $list = $list->orderBy('id', 'desc')->paginate($page);
        return $list;
    }

    /**
     * 根据ID修改MCN机构状态
     * @param $id
     * @param $state
     * @return bool
     */
    public function changeStateById($id,$state)
    {
        if ($state == 1){
            $data['state'] = 2;
        } else {
            $data['state'] = 1;
        }
        return $this->where('id','=',$id)->update($data);
    }
}
