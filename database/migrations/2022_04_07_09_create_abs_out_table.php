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
        Schema::create('abs_out', function (Blueprint $table) {
            $table->id('abs_out_id');
            $table->foreignId('abs_emp_id');
            $table->foreignId('abs_in_id');
            $table->date('abs_date');
            $table->time('abs_time');
            $table->text('abs_reason');
            $table->string('abs_longitude_out');
            $table->string('abs_latitude_out');
            $table->string('abs_address_out');
            $table->string('abs_zone_region_out');
            $table->string('abs_zone_time_out');
            $table->string('status_check_out');

            // Foreign Key
            $table->foreign('abs_emp_id')->references('emp_id')->on('emp_person')->onDelete('cascade');
            $table->foreign('abs_in_id')->references('abs_in_id')->on('abs_in')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abs_out');
    }
};
