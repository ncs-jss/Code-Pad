<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TotalResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TotalResult', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_id');
            $table->string('time');
            $table->string('score');
            $table->string('attempt');
            $table->unsignedInteger('record_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('TotalResult');
    }
}
