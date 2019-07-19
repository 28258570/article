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
        return view('admin.mcn.index');
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
            $file_cover = $request->file('cover');
            $file_cover_name = FileUpload::fileUpload($file_cover,'mcn');
            dd($file_cover_name);
//            $params['name'] = $request->input('name');
//            $params['introduce'] = $request->input('introduce');
//            $params['price'] = $request->input('price');
//            $params['content'] = $request->input('content');
//            $params['cover'] = $file_cover_name;
//            Mcn::addData($params);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload(Request $request)
    {
        dd();
//        $str=file_get_contents($_FILE['f']['tmp_name']);
    }
}
