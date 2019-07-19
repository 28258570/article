<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    /**
     * 图片上传
     * @param $file
     * @param $folder
     * @return bool|string
     */
    public static function fileUpload($file,$folder)
    {
        if ($file->isValid()) {
            $ext = $file->getClientOriginalExtension();//上传图片路径
            $file_path = 'uploads/'.$folder;
            $file_name = uniqid() . date('YmdHis',time()) .'.' .$ext;
            $file->move($file_path,$file_name);
            return $file_path.'/'.$file_name;
        } else {
            return false;
        }
    }
}
