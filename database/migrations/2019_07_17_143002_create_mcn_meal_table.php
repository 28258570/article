<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcnMealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mcn_meal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('MCN套餐名称');
            $table->string('cover', 200)->comment('套餐封面');
            $table->string('introduce')->default('')->comment('套餐介绍');
            $table->string('mcn_id')->default('')->comment('MCN机构ID');
            $table->decimal('price',5,2)->default(0)->comment('价格');
            $table->integer('state')->default(1)->comment('状态：默认是1 下架，2 上架');
            $table->timestamps();
        });
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
