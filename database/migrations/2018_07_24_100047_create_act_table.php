<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('c_id');
            $table->string('name')->comment('活动名称');
            $table->string('longitude')->comment('经度');
            $table->string('latitude')->comment('纬度');
            $table->integer('status')->nullable()->unsigned()->comment('活动状态');
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
        Schema::dropIfExists('act');
    }
}
