<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminRole;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CenterController extends Controller
{
    /**
     * 个人中心
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $admin = (new AdminRole())->where('admin_id','=',session('admin_id'))->first();
        $role = Role::all();
        return view('admin.center.index',[
            'role' => $role,
            'role_id' => $admin->role_id
        ]);
    }
}
