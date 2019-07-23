<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * 用户列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $list = User::getData($params);
        return view('admin.user.index',[
            'list' => $list,
            'params' => $params,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除用户
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $res = User::destroy($id);
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

    /**
     * 查看用户购买信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function order(Request $request)
    {
        try {
            $user = (new User())->find($request->input('id'));
            $data['mobile'] = $user->mobile;
            $result = ['status' => 1, 'data' => $data];
        }catch(\Exception $e) {
            $result = ['status' => 0, 'data' => ''];
        }
        return response()->json($result);
    }
}
