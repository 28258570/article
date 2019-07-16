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
	
	//MCN列表
    public function mcnList()
    {
        return view('home.index.mcnList');
    }
	
	//MCN商品详情
    public function mcnDetail()
    {
        return view('home.index.mcnDetail');
    }
}
