<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class McnMeal extends Model
{
    //
    protected $table = 'mcn_meal';

    /**
     * 获取MCN机构列表
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getMcnList()
    {
        return Mcn::all();
    }

    /**
     * 添加MCN机构套餐
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
        $model->mcn_id = $params['mcn_id'];
        $model->state = 1;
        return $model->save();
    }

    /**
     * MCN机构套餐列表
     * @param $params
     * @param int $page
     * @return McnMeal|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getData($params,$page=10)
    {
        $list = new self();

        $list = $list->orderBy('id', 'desc')->paginate($page);
        return $list;
    }

    /**
     * 根据ID修改MCN机构套餐状态
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

    /**
     * 根据ID修改MCN机构套餐
     * @param $id
     * @param $params
     * @return bool
     */
    public static function updateData($id,$params)
    {
        return (new self())->where('id','=',$id)->update($params);
    }
}
