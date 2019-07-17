<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * 登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->session()->has('username') && $request->session()->has('admin_id')){
            return redirect('admin/center');
        }
        return view('admin.login.index');
    }

    /**
     * 登录验证
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = $request->all();
        $model = new Admin();
        $user = $model->where('username','=',$data['username'])->first();
        if (\Hash::check($data['password'] ,$user->password)){
            $request->session()->put('username', $user->username);
            $request->session()->put('admin_id', $user->id);
            $result = ['status' => 1, 'msg' => '登陆成功'];
        } else {
            $result = ['status' => 0, 'msg' => '登陆失败'];
        }
        return response()->json($result);
    }

    /**
     * 注销
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/HT');
    }
}
