<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMcnToMenu extends Migration
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
            'menu_name' => 'MCN机构管理',
            'describe' => 'MCN机构管理',
            'menu_url' => '/admin/mcn',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')
        ]);

        \DB::table('menu')->insert([
            'menu_name' => 'MCN机构套餐管理',
            'describe' => 'MCN机构套餐管理',
            'menu_url' => '/admin/mcnMeal',
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
