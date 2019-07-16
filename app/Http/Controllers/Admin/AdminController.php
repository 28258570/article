<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

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

    /**
     * 修改管理员
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

        if (!(empty($data['password']) && empty($data['re_password']) && empty($data['new_password']))){
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
        }

        if (!($data['username'] == $user->username)){
            $params['username'] = $data['username'];
        }

        if ($key){
            $user->where('id','=',$id)->update($params);
            $message = '修改成功';
        }

        return redirect("/admin/admin/$id/edit")->with('msg', $message);
    }

    /**
     * 设置角色
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function role(Request $request,$id)
    {
        if ($request->isMethod('post')){
            $params['admin_id'] = $id;
            $params['role_id'] = $request->input('role');
            $res = AdminRole::setRole($params);
            if ($res){
                $result = ['status' => 1, 'msg' => '设置成功'];
            } else {
                $result = ['status' => 0, 'msg' => '设置失败'];
            }
            return response()->json($result);
        } else {
            $role = Role::all();
            return view('admin.admin.role',[
                'id' => $id,
                'role' => $role,
            ]);
        }
    }

    /**
     * 删除管理员
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $res = Admin::destroy($id);
            if ($res){
                $result = ['status' => 1, 'msg' => '删除成功'];
            } else {
                $result = ['status' => 0, 'msg' => '删除失败'];
            }
        }catch(\Exception $e) {
            $result = ['status' => 0, 'msg' => $e->getMessage()];
        }
        return response()->json($result);
    }
}
