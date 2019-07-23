<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_num',200)->comment('订单编号');
            $table->integer('user_id')->comment('用户ID');
            $table->integer('mcn_id')->comment('购买的商品ID');
            $table->decimal('price',5,2)->comment('实付金额');
            $table->integer('type')->comment('购买类型：1是MCN机构，2是MCN机构套餐');
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
