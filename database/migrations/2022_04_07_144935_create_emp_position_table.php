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
        Schema::create('emp_position', function (Blueprint $table) {
            $table->id('emp_pos_id');
            $table->foreignId('emp_id');
            $table->foreignId('emp_department');
            $table->foreignId('emp_division');
            $table->foreignId('emp_position');
            $table->foreignId('emp_grade');
            $table->foreignId('emp_coach');
            $table->foreignId('emp_manager');
            $table->integer('emp_status');

            // Foreign Key
            $table->foreign('emp_id')->references('emp_id')->on('emp_person')->onDelete('cascade');
            $table->foreign('emp_department')->references('dept_id')->on('tbl_department')->onDelete('cascade');
            $table->foreign('emp_division')->references('division_id')->on('tbl_division')->onDelete('cascade');
            $table->foreign('emp_position')->references('pos_id')->on('tbl_position')->onDelete('cascade');
            $table->foreign('emp_grade')->references('grade_id')->on('tbl_grade')->onDelete('cascade');
            $table->foreign('emp_coach')->references('emp_id')->on('emp_person')->onDelete('cascade');
            $table->foreign('emp_manager')->references('emp_id')->on('emp_person')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_position');
    }
};
