<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mcn', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('MCN名称');
            $table->string('cover', 200)->comment('封面');
            $table->string('introduce')->default('')->comment('介绍');
            $table->decimal('price',5,2)->default(0)->comment('价格');
            $table->text('content')->comment('内容');
            $table->string('picture')->default('')->comment('内容图片');
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
