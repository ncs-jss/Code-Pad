<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudentsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_details', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('photo_path');
            $table->string('branch');
            $table->string('year');
            $table->string('mobile');
            $table->string('gender');
            $table->timestamps();
            $table->foreign('id')->references('id')->on('student');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students_details');
    }
}
