<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TeacherDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo_path')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedInteger('teacher_id');
            $table->timestamps();
            $table->foreign('teacher_id')->references('id')->on('teacher');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('teachers_details');
    }
}
