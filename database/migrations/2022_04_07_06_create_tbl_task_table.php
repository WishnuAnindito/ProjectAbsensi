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
        Schema::create('tbl_task', function (Blueprint $table) {
            $table->id('task_id');
            $table->foreignId('task_assign_by');
            $table->foreignId('task_assign_to');
            $table->string('task_name');
            $table->date('task_date');
            $table->time('task_start_time');
            $table->time('task_end_time');
            $table->string('task_zone_time');
            $table->string('task_address');
            $table->string('task_city');
            $table->string('task_emp_status');
            $table->string('task_lead_status');

            $table->foreign('task_assign_by')->references('emp_id')->on('emp_person')->onDelete('cascade');
            $table->foreign('task_assign_to')->references('emp_id')->on('emp_person')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_task');
    }
};
