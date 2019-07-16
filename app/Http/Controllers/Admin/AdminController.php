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
    public function index(Request $request)
    {
        $params = $request->all();
        $list = Admin::getData($params);
        return view('admin.admin.index',[
            'list' => $list
        ]);
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

    /**
     * 修改管理员页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = (new Admin())->find($id);
        return view('admin.admin.edit',[
            'data' => $data
        ]);
    }

    public function update(Request $request,$id)
    {
        $user = (new Admin())->find($id);
        $data = $request->all();
        $params = [];
        $key = true;
        if (trim($data['new_password']) != trim($data['re_password'])){
            $message = '新密码和确认密码必须相同';
            $key = false;
        }

        if (!strlen($data['new_password']) > 5){
            $message = '密码必须大于6位';
            $key = false;
        }

        if (\Hash::check($data['password'] ,$user->password)){
            $params['password'] = bcrypt($data['new_password']);
        } else {
            $message = '原密码错误';
            $key = false;
        }

        if (!($data['username'] == $user->username)){
            $params['username'] = $data['username'];
        }

        if ($key){
            $user->where('id','=',$id)->update($params);
            $message = '修改成功';
        }

        return redirect("/admin/$id/edit")->with('msg', $message);
    }
}
