<?php

namespace App\Http\Controllers\Admin;

use App\Models\FileUpload;
use App\Models\Mcn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class McnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $list = Mcn::getData($params);
        return view('admin.mcn.index',[
            'list' => $list
        ]);
    }

    /**
     * 添加MCN管理界面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mcn.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {

            try{
                $file_cover = $request->file('cover');
                $file_cover_name = FileUpload::fileUpload($file_cover,'mcn');
                $params['name'] = $request->input('name');
                $params['introduce'] = $request->input('introduce');
                $params['price'] = $request->input('price');
                $params['content'] = $request->input('content');
                $params['cover'] = $file_cover_name;
                $res = Mcn::addData($params);
                if ($res){
                    $result = ['status' => 1, 'msg' => '添加成功'];
                } else {
                    $result = ['status' => 0, 'msg' => '添加失败'];
                }
            } catch (\Exception $e){
                $result = ['status' => 0, 'msg' => $e->getMessage()];
            }
            return response()->json($result);
        }
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
        $data = (new Mcn())->find($id);
        return view('admin.mcn.edit',[
            'data' => $data
        ]);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 解析上传文件的内容并解析
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        try {
            if ('docx' == $request->file('file')->getClientOriginalExtension()){
                $content = FileUpload::parseWord($request->file('file')->getRealPath());
                $result = ['status' => 1, 'data' => $content];
            } else {
                $result = ['status' => 0, 'data' => ''];
            }
        }catch(\Exception $e) {
            $result = ['status' => 0, 'data' => ''];
        }
        return response()->json($result);
    }
}
