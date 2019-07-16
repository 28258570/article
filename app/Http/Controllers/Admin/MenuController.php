<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * 菜单管理列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $list = Menu::getData($params);
        return view('admin.menu.index',[
            'list' => $list,
            'params' => $params
        ]);
    }

    public function create()
    {
        Menu::getMenu();
//        return view('admin.menu.create');
    }
}
