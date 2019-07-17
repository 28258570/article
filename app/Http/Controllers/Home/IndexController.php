<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //主页
    public function index()
    {
        return view('home.index.index');
    }
	
	//MCN机构列表
    public function mcnList()
    {
        return view('home.index.mcnList');
    }
	
	//自媒体攻略
    public function zimei()
    {
        return view('home.index.zimei');
    }
	
	//新媒体攻略
    public function xinmei()
    {
        return view('home.index.xinmei');
    }
	
	//加盟合作
    public function joinIn()
    {
        return view('home.index.joinIn');
    }
	
	//友情链接
    public function links()
    {
        return view('home.index.links');
    }
	
}
