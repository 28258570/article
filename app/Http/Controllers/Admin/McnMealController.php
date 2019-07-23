<?php

namespace App\Http\Controllers\Admin;

use App\Models\FileUpload;
use App\Models\McnMeal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class McnMealController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * MCN机构套餐列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $list = McnMeal::getData($params);
        return view('admin.mcnMeal.index',[
            'list' => $list
        ]);
    }

    /**
     * 添加MCN机构套餐界面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mcnMeal.create');
    }

    /**
     * 添加MCN机构套餐
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $file_cover = $request->file('cover');
            $file_cover_name = FileUpload::fileUpload($file_cover,'mcnMeal');
            $params['name'] = $request->input('name');
            $params['introduce'] = $request->input('introduce');
            $params['price'] = $request->input('price');
            $params['mcn_id'] = $request->input('mcn_id');
            $params['cover'] = $file_cover_name;
            $res = McnMeal::addData($params);
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
     * 修改MCN套餐界面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = (new McnMeal())->find($id);
        $data->mcn_id = explode(',',$data->mcn_id);
        return view('admin.mcnMeal.edit',[
            'data' => $data
        ]);
    }

    /**
     * 修改MCN套餐
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $file_cover = $request->file('cover');
            $file_cover_name = FileUpload::fileUpload($file_cover,'mcnMeal');
            $params['name'] = $request->input('name');
            $params['introduce'] = $request->input('introduce');
            $params['price'] = $request->input('price');
            $params['mcn_id'] = $request->input('mcn_id');
            $params['cover'] = $file_cover_name;
            $res = McnMeal::updateData($id,$params);
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
     * 删除MCN机构套餐
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $res = McnMeal::destroy($id);
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
     * 上架下架
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function change(Request $request)
    {
        try {
            $res = (new McnMeal())->changeStateById($request->input('id'),$request->input('state'));
            if ($res){
                $result = ['status' => 1, 'msg' => '操作成功'];
            } else {
                $result = ['status' => 0, 'msg' => '操作失败'];
            }
        }catch(\Exception $e) {
            $result = ['status' => 0, 'msg' => $e->getMessage()];
        }
        return response()->json($result);
    }

    /**
     * 批量删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDel(Request $request)
    {
        try {
            $ids = explode(',',$request->input('id'));
            $res = McnMeal::destroy($ids);
            if ($res > 0){
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
