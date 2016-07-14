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
            $table->unsignedInteger('id');
            $table->string('photo_path');
            $table->string('department');
            $table->string('position');
            $table->string('mobile');
            $table->string('gender');
            $table->timestamps();
            $table->foreign('id')->references('id')->on('teacher');
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
