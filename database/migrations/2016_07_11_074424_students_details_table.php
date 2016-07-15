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
            $table->increments('id');
            $table->string('photo_path')->nullable();
            $table->string('branch')->nullable();
            $table->string('year')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedInteger('student_id');
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('student');
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
