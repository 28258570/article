<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyController extends Controller
{
    
	//MCN商品详情
    public function mcnDetail()
    {
        return view('home.buyDetail.mcnDetail');
    }
	
	
}
