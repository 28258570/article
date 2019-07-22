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

    /**
     * 将DOCX文件内容解析
     * @param $file
     * @return string
     */
    public static function parseWord($file) {
        $content = "";
        $zip = new \ZipArchive();
        if ($zip->open ($file) === TRUE ) {
            for($i = 0; $i < $zip->numFiles; $i ++) {
                $entry = $zip->getNameIndex ( $i );
                if (pathinfo ($entry,PATHINFO_BASENAME) == "document.xml") {
                    $zip->extractTo (pathinfo ($file, PATHINFO_DIRNAME ) . "/" . pathinfo ($file, PATHINFO_FILENAME ), array (
                        $entry
                    ) );
                    $filepath = pathinfo ($file, PATHINFO_DIRNAME ) . "/" . pathinfo ( $file, PATHINFO_FILENAME ) . "/" . $entry;
                    $content = strip_tags ( file_get_contents ( $filepath ) );
                    break;
                }
            }
            $zip->close();
            return $content;
        } else {
           return $content;
        }
    }
}
