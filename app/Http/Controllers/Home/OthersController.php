<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OthersController extends Controller
{
   
   //意见反馈
    public function feedBack()
    {
        return view('home.others.feedBack');
    }
   
}
