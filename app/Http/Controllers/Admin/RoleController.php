<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * 角色管理列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Role::getData();
        return view('admin.role.index',[
            'list' => $list
        ]);
    }

    /**
     * 添加角色页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * 添加角色
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $params = $request->all();
            $res = Role::addData($params);
            if ($res){
                $result = ['status' => 1, 'msg' => '添加成功'];
            } else {
                $result = ['status' => 0, 'msg' => '添加失败'];
            }
        }catch(\Exception $e) {
            $result = ['status' => 0, 'msg' => $e->getMessage()];
        }
        return response()->json($result);
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
        $data = (new Role())->find($id);
        return view('admin.role.edit',[
            'data' => $data
        ]);
    }

    /**
     * 修改角色信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data['name'] = $request->input('name');
            $data['description'] = $request->input('description');
            $res = (new Role())->where('id','=',$id)->update($data);
            if ($res){
                $result = ['status' => 1, 'msg' => '修改成功'];
            } else {
                $result = ['status' => 0, 'msg' => '修改失败'];
            }
        }catch(\Exception $e) {
            $result = ['status' => 0, 'msg' => $e->getMessage()];
        }
        return response()->json($result);
    }

    /**
     * 删除角色
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $res = Role::destroy($id);
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
     * 设置权限
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function role($id)
    {
        $menu = Menu::all();
        $role = (new Role())->find($id);
        $menu_ids = explode(',',$role['menu_ids']);
        return view('admin.role.role',[
            'id' => $id,
            'menu' => $menu,
            'menu_ids' => $menu_ids
        ]);
    }

    /**
     * 设置权限
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function auth(Request $request)
    {
        try {
            $res = Role::addMenuIds($request->all());
            if ($res){
                $result = ['status' => 1, 'msg' => '设置成功'];
            } else {
                $result = ['status' => 0, 'msg' => '设置失败'];
            }
        }catch(\Exception $e) {
            $result = ['status' => 0, 'msg' => $e->getMessage()];
        }
        return response()->json($result);
    }
}
