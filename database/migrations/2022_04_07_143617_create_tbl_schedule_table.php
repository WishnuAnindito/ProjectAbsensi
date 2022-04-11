<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_schedule', function (Blueprint $table) {
            $table->id('sch_id');
            $table->foreignId('leader_id');
            $table->foreignId('emp_id');
            $table->string('task_name');
            $table->date('date');
            $table->time('time_in');
            $table->time('time_out');
            $table->string('location');
            
            // Foreign Key
            $table->foreign('emp_id')->references('emp_id')->on('emp_person')->onDelete('cascade');
            $table->foreign('leader_id')->references('emp_id')->on('emp_person')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_schedule');
    }
};
