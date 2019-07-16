<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMenuToMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        \DB::table('menu')->insert([
            'menu_name' => '管理员管理',
            'describe' => '管理员列表',
            'menu_url' => '/admin/admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        \DB::table('menu')->insert([
            'menu_name' => '菜单管理',
            'describe' => '菜单列表',
            'menu_url' => '/admin/menu',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        \DB::table('menu')->insert([
            'menu_name' => '角色管理',
            'describe' => '角色列表',
            'menu_url' => '/admin/role',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
