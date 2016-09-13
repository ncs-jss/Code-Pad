<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompilerProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('program_name');
            $table->text('program_statement');
            $table->string('difficulty');
            $table->text('sample_input')->nullable();
            $table->text('sample_output')->nullable();
            $table->text('sample_explanation')->nullable();
            $table->string('time');
            $table->string('marks');
            $table->text('testcases_input');
            $table->text('testcases_output');
            $table->unsignedInteger('record_id');
            $table->timestamps();
            $table->foreign('record_id')->references('id')->on('compiler_record');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('program_details');
    }
}
