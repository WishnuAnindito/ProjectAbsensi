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
        Schema::create('abs_in', function (Blueprint $table) {
            $table->id('abs_in_id');
            $table->foreignId('task_id');
            $table->foreignId('abs_emp_id');
            $table->date('abs_date');
            $table->time('abs_time');
            $table->text('abs_reason');
            $table->string('abs_longitude_in');
            $table->string('abs_latitude_in');
            $table->string('abs_address_in');
            $table->string('abs_zone_region_in');
            $table->string('abs_zone_time_in');
            $table->string('status_check_in');
            
            // Foreign Key
            $table->foreign('task_id')->references('task_id')->on('tbl_task')->onDelete('cascade');
            $table->foreign('abs_emp_id')->references('emp_id')->on('emp_person')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abs_in');
    }
};
