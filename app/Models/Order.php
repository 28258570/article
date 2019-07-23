<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'order';

    /**
     * 获取用户信息
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getUser()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    /**
     * 获取MCN机构信息
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getMcn()
    {
        return $this->hasOne('App\Models\Mcn','id','mcn_id');
    }

    /**
     * 获取MCN机构套餐信息
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getMcnMeal()
    {
        return $this->hasOne('App\Models\McnMeal','id','mcn_id');
    }

    /**
     * 订单列表
     * @param $params
     * @param int $page
     * @return $this|Order|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getData($params,$page=10)
    {
        $list = (new self())->select('order.*')
            ->where(function ($query) use ($params) {
                if (!empty($params['order_num'])) {
                    $query->where('order.order_num', '=', $params['order_num']);
                }
            })
            ->where(function ($query) use ($params) {
                if (!empty($params['mobile'])) {
                    $query->where('user.mobile', '=', $params['mobile']);
                }
            })
            ->where(function ($query) use ($params) {
                if (!empty($params['start']) && !empty($params['end'])) {
                    $query->whereBetween('order.created_at',[$params['start'].' 00:00:00',$params['end'].' 23:59:59']);
                }
            })
            ->leftjoin('user','order.user_id','=','user.id')
            ->orderBy('order.id','desc')
            ->paginate($page);
        return $list;
    }
}
