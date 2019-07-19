<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mcn extends Model
{
    //
    protected $table = 'mcn';

    public static function addData($params)
    {
        $model = (new self());
        $model->name = $params['name'];
        $model->cover = $params['cover'];
        $model->introduce = $params['introduce'];
        $model->price = $params['price'];
        $model->content = $params['content'];
        $model->picture = $params['picture'];
        $model->state = 1;
        dd($params);
    }
}
