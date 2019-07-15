<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * 管理员列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        return view('admin.admin.index');
    }

    /**
     * 添加管理员页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * 添加管理员
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'username'      => 'required|unique:admin',
            'password'      => 'required|min:6|same:re_password',
            're_password'    => 'required',
        ], [
            'username.required'        => '请输入用户名',
            'username.unique'          => '你输入的用户名已被注册',
            'password.min'           => '密码必须是6位',
            'password.same'          => '密码和确认密码必须相同',
        ]);

        if($validator->fails()) {
            $result = false;
            $message = $validator->getMessageBag()->first();
        } else {
            try {
                $res = Admin::AddData($data);
                if ($res){
                    return response()->json(['status' => 1, 'msg' => '注册成功']);
                } else {
                    return response()->json(['status' => 0, 'msg' => '注册失败']);
                }
            }catch(\Exception $e) {
                return response()->json(['status' => 0, 'msg' => $e->getMessage()]);
            }
        }
        return response()->json(['status' => $result,'msg' => $message]);
    }
}
